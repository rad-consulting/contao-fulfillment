<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model\Product;

use Contao\Config as Settings;
use Contao\Database;
use Contao\Model\Collection;
use Exception;
use Isotope\Model\Product\Standard;
use Isotope\Model\ProductType;
use RAD\Log\Model\Log;
use RAD\Fulfillment\Unit\EAN;
use RAD\Fulfillment\Unit\TOD;

/**
 * Class Fulfillment
 *
 * @property int    $id
 * @property int    $rad_ean
 * @property string $rad_export
 * @property int    $rad_exported
 * @property int    $rad_stock
 * @property int    $rad_updated
 * @property float  $rad_width
 * @property float  $rad_weight
 * @property float  $rad_length
 * @property float  $rad_height
 * @property string $rad_sku
 * @property string $rad_unit
 * @property string $rad_volume
 */
class Fulfillment extends Standard
{
    /**
     * @param string $type
     * @param bool   $variants
     * @param array  $options
     * @return Collection
     */
    public static function findByType($type, $variants = false, array $options = array())
    {
        $db = Database::getInstance();
        $types = $db->prepare('SELECT GROUP_CONCAT(id) AS ids FROM ' . ProductType::getTable() . ' WHERE `class` = ?')->execute($type);
        $result = $db->prepare(' SELECT id FROM ' . static::getTable() . ' WHERE `pid` = 0 AND `type` IN (' . $types->ids . ') ORDER BY `name` ASC')
                     ->execute();
        $models = array();

        while ($result->next()) {
            $product = static::findByPk($result->id);

            if ($variants && $product->hasVariants()) {
                $variants = static::findMultipleByIds($product->getVariantIds());

                if ($variants) {
                    foreach ($variants as $variant) {
                        $models[] = $variant;
                    }
                }
            }
            else {
                $models[] = $product;
            }
        }

        return new Collection($models, static::getTable());
    }

    /**
     * @inheritdoc
     */
    public function getEAN()
    {
        if (!isset($this->arrData['rad_ean'])) {
            return new EAN\EAN(0, EAN\Unit::HE);
        }

        return EAN\EAN::createFromTimePeriod($this->arrData['rad_ean']);
    }

    /**
     * @param EAN\EAN|string $ean
     * @param string         $type
     * @return $this
     */
    public function setEAN($ean, $type = EAN\Unit::HE)
    {
        $this->rad_ean = serialize(array('value' => $ean instanceof EAN\EAN ? $ean->getValue() : $ean, 'unit' => $ean instanceof EAN\EAN ? $ean->getUnit() : $type));

        return $this;
    }

    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->rad_sku;
    }

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->rad_stock;
    }

    /**
     * @param int $stock
     * @return $this
     */
    public function setStock($stock)
    {
        $this->rad_stock = (int)$stock;

        return $this;
    }

    /**
     * @return bool
     */
    public function doExport()
    {
        return '' != $this->rad_export;
    }

    /**
     * @return string
     */
    public function getExport()
    {
        return $this->rad_export;
    }

    /**
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setExported($message = null, $data = null)
    {
        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->rad_exported = time();

        switch ($this->rad_export) {
            case 'I':
                $this->rad_export = 'U';
                break;

            case 'D':
                $this->rad_export = '';
                break;

            default:
        }

        return $this;
    }

    /**
     * TOD - term of delivery, not death ;-)
     *
     * @return TOD\TOD
     */
    public function getTOD()
    {
        $type = ProductType::findByPk($this->type)->class;
        $state = 0 < $this->getStock() ? 'onstock' : 'outofstock';
        $fallback = deserialize(Settings::get("rad_fulfillment_termofdelivery"), true);
        $override = deserialize(Settings::get("rad_{$type}_termofdelivery"), true);

        foreach ($override as $tod) {
            if ($tod['type'] == $state) {
                return new TOD\TOD($tod['value'], $tod['unit']);
            }
        }

        foreach ($fallback as $tod) {
            if ($tod['type'] == $state) {
                return new TOD\TOD($tod['value'], $tod['unit']);
            }
        }

        return new TOD\TOD('1-2', TOD\Unit::DAYS);
    }

    /**
     * @param bool        $updated
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setUpdated($updated = true, $message = null, $data = null)
    {
        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->rad_updated = $updated ? time() : 0;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->rad_unit;
    }

    /**
     * @param string|Exception $message
     * @param int              $level
     * @param string|null      $data
     * @return $this
     */
    public function log($message, $level = Log::INFO, $data = null)
    {
        if ($message instanceof Exception) {
            $message = $message->getMessage();
        }

        Log::factory($this, $message, $level, $data)->save();

        return $this;
    }
}
