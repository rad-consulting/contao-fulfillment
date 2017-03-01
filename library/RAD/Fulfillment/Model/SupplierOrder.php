<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model;

use RAD\Log\Model\Log;

/**
 * Class SupplierOrder
 *
 * @property int    $export
 * @property int    $exported
 * @property string $positions
 * @property string $reference
 */
class SupplierOrder extends AbstractModel
{
    /**
     * @var string
     */
    public static $strTable = 'tl_rad_supplier_order';

    /**
     * @return array
     */
    public function getPositions()
    {
        return deserialize($this->positions, true);
    }

    /**
     * @return bool
     */
    public function doExport()
    {
        return (bool)$this->export;
    }

    /**
     * @return bool
     */
    public function isExported()
    {
        return (bool)$this->exported;
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

        $this->export = 0;
        $this->exported = (int)$exported;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string      $reference
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setReference($reference, $message = null, $data = null)
    {
        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->reference = $reference;

        return $this;
    }
}
