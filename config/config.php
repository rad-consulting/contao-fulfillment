<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\FulfillmentModel::getTable()] = 'RAD\\Fulfillment\\Model\\FulfillmentModel';
$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\SupplierOrderModel::getTable()] = 'RAD\\Fulfillment\\Model\\SupplierOrderModel';
$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\Product\FulfillmentProduct::getTable()] = 'RAD\\Fulfillment\\Model\\Product\\FulfillmentProduct';
$GLOBALS['ISO_HOOKS']['postCheckout'][] = array('RAD\\Fulfillment\\Service', 'postCheckout');
$GLOBALS['RAD_SUBSCRIBERS'][] = 'RAD\\Fulfillment\\Service';
$GLOBALS['BE_MOD']['isotope']['iso_products']['tables'][] = 'tl_rad_log';

if (!is_array($GLOBALS['BE_MOD']['fulfillment'])) {
    $index = array_search('isotope', array_keys($GLOBALS['BE_MOD']));
    array_insert($GLOBALS['BE_MOD'], $index + 1, array('fulfillment' => array(
        'fulfillments' => array(
            'tables' => array('tl_rad_fulfillment', 'tl_rad_log'),
            'icon' => 'system/themes/flexible/images/about.gif',
        ),
        'supplierorders' => array(
            'tables' => array('tl_rad_supplier_order', 'tl_rad_log'),
            'icon' => 'system/themes/flexible/images/about.gif',
        ),
    )));
}
