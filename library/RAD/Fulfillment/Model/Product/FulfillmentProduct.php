<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model\Product;

use Exception;
use Haste\Units\Mass;
use Isotope\Model\Product\Standard;
use RAD\Log\Model\LogModel as Log;
use RAD\Fulfillment\Unit\Dimension;

/**
 * Class FulfillmentProduct
 *
 * @property int    $id
 * @property int    $rad_ean
 * @property int    $rad_export
 * @property int    $rad_exported
 * @property int    $rad_stock
 * @property int    $rad_updated
 * @property float  $rad_width
 * @property float  $rad_weight
 * @property float  $rad_length
 * @property float  $rad_height
 * @property string $rad_sku
 * @property string $rad_volume
 */
class FulfillmentProduct extends Standard
{
    /**
     * @inheritdoc
     */
    public function getEAN()
    {
        return $this->rad_ean;
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
        return (bool)$this->rad_export;
    }

    /**
     * @inheritdoc
     */
    public function isExported()
    {
        return (bool)$this->rad_exported;
    }

    /**
     * @param bool        $exported
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setExported($exported = true, $message = null, $data = null)
    {
        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->rad_exported = (int)$exported;

        return $this;
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
     * @return Dimension\Dimension
     */
    public function getHeight()
    {
        if (!isset($this->arrData['rad_height'])) {
            return new Dimension\Dimension(0, Dimension\Unit::CENTIMETER);
        }

        return Dimension\Dimension::createFromTimePeriod($this->arrData['rad_height']);
    }

    /**
     * @return Dimension\Dimension
     */
    public function getLength()
    {
        if (!isset($this->arrData['rad_length'])) {
            return new Dimension\Dimension(0, Dimension\Unit::CENTIMETER);
        }

        return Dimension\Dimension::createFromTimePeriod($this->arrData['rad_length']);
    }

    /**
     * @return Dimension\Dimension
     */
    public function getWidth()
    {
        if (!isset($this->arrData['rad_width'])) {
            return new Dimension\Dimension(0, Dimension\Unit::CENTIMETER);
        }

        return Dimension\Dimension::createFromTimePeriod($this->arrData['rad_width']);
    }

    /**
     * @return \Haste\Units\Mass\Weight
     */
    public function getWeightGross()
    {
        if (!isset($this->arrData['shipping_weight'])) {
            return new Mass\Weight(0, Mass\Unit::KILOGRAM);
        }

        return Mass\Weight::createFromTimePeriod($this->arrData['shipping_weight']);
    }

    /**
     * @return \Haste\Units\Mass\Weight
     */
    public function getWeightNet()
    {
        if (!isset($this->arrData['rad_weight'])) {
            return new Mass\Weight(0, Mass\Unit::KILOGRAM);
        }

        return Mass\Weight::createFromTimePeriod($this->arrData['rad_weight']);
    }

    /**
     * @return float
     */
    public function getVolume()
    {
        return $this->rad_volume;
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
