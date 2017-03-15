<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
namespace RAD\Fulfillment\Backend;

use Contao\DataContainer;
use Isotope\Model\ProductCollection\Order;

/**
 * Class Listing
 */
class Listing
{
    /**
     * @param array         $row
     * @param string        $label
     * @param DataContainer $dc
     * @param array         $args
     * @return array
     */
    public function listFulfillment(array &$row, $label, DataContainer $dc, array &$args)
    {
        $order = Order::findByPk($row['pid']);

        $args[1] = date('Y-m-d H:i:s', $row['tstamp']);
        $args[2] = $order->document_number;

        return $args;
    }

    /**
     * @param array         $row
     * @param string        $label
     * @param DataContainer $dc
     * @param array         $args
     * @return array
     */
    public function listSupplierOrder(array &$row, $label, DataContainer $dc, array &$args)
    {
        $args[1] = date('Y-m-d H:i:s', $row['tstamp']);

        return $args;
    }
}
