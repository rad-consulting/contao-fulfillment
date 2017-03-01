<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Backend;

use Isotope\Model\Product;
use RAD\Log\Backend\Button as LogButton;

/**
 * Class Button
 */
class Button extends LogButton
{
    /**
     * @param array  $row
     * @param string $href
     * @param string $label
     * @param string $title
     * @param string $icon
     * @param string $attributes
     * @return string
     */
    public function forLog(array &$row, $href, $label, $title, $icon, $attributes)
    {
        $product = Product::findByPk($row['id']);

        if ($product instanceof Product\Standard) {
            if (in_array('rad_export', $product->isVariant() ? $product->getType()->getVariantAttributes() : $product->getType()->getAttributes())) {
                return parent::forLog($row, $href, $label, $title, $icon, $attributes);
            }
        }

        return '';
    }
}
