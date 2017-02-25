<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Backend;

use Contao\Backend;
use Contao\DataContainer;
use Isotope\Model\Product;
use Isotope\Model\ProductType;
use MultiColumnWizard;

/**
 * Class Panel
 */
class Panel extends Backend
{
    /**
     * @param DataContainer|MultiColumnWizard $dc
     * @return array
     */
    public function getOptionsProduct($dc)
    {
        if ($dc instanceof MultiColumnWizard) {
            $dc = $dc->dataContainer;
        }

        $db = $this->Database;
        $type = $dc->activeRecord->producttype;
        $options = array();

        if ($type) {
            $types = $db->prepare('SELECT GROUP_CONCAT(`id`) AS `ids` FROM ' . ProductType::getTable() . ' WHERE `class` = ? ORDER BY `name` ASC LIMIT 1')->execute($type);
            $products = $db->prepare('SELECT `id` FROM ' . Product::getTable() . ' WHERE `pid` = 0 AND `type` IN ( ' . $types->ids . ') ORDER BY `type` ASC, `name` ASC')->execute();
        }
        else {
            $products = $db->prepare('SELECT `id` FROM ' . Product::getTable() . ' WHERE `pid` = 0 ORDER BY `name` ASC');
        }

        for ($i = 0; $i < $products->numRows; $i++, $products->next()) {
            $product = Product::findByPk($products->id);

            if (!($product instanceof Product)) {
                continue;
            }

            $variants = $db->prepare('SELECT `id` FROM ' . Product::getTable() . ' WHERE `pid` = ? ORDER BY `name` ASC')->execute($product->getId());

            if (!$variants->numRows) {
                $options[$product->getId()] = $product->getName();
                continue;
            }

            for ($j = 0; $j < $variants->numRows; $j++, $variants->next()) {
                $variant = Product::findByPk($variants->id);

                if ($variant instanceof Product) {
                    $options[$variant->getId()] = $variant->getName();
                }
            }
        }

        return $options;
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getOptionsProductType(DataContainer $dc)
    {
        $options = array();

        foreach (array_keys(Product::getModelTypes()) as $option) {
            $options[$option] = $GLOBALS['TL_LANG']['MODEL']['tl_iso_product'][$option];
        }

        asort($options);

        return $options;
    }
}
