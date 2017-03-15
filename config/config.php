<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */

// Backend modules
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

// Models
\Isotope\Model\Shipping::registerModelType('swisspost', 'RAD\\Fulfillment\\Model\\Shipping\\Swisspost');
$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\Fulfillment::getTable()] = 'RAD\\Fulfillment\\Model\\Fulfillment';
$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\SupplierOrder::getTable()] = 'RAD\\Fulfillment\\Model\\SupplierOrder';

// Isotope hooks
$GLOBALS['ISO_HOOKS']['generateProduct'][] = array('RAD\\Fulfillment\\Frontend', 'onGenerateProduct');
$GLOBALS['ISO_HOOKS']['postCheckout'][] = array('RAD\\Fulfillment\\Service', 'onPostCheckout');

// Notifications
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['fulfillment']['fulfillment_status_change']['recipients'] = array('admin_email');
$GLOBALS['NOTIFICATION_CENTER']['NOTIFICATION_TYPE']['fulfillment']['fulfillment_status_change']['email_text'] = array('order_id', 'fulfillment_id', 'fulfillment_*', 'order_items', 'shipping_address', 'shipping_address_*');

// Modifications
$GLOBALS['BE_MOD']['isotope']['iso_products']['tables'][] = 'tl_rad_log';
$GLOBALS['RAD_SUBSCRIBERS'][] = 'RAD\\Fulfillment\\Service';
$GLOBALS['RAD_LOG_ENTITIES']['fulfillments'] = array('ptable' => 'tl_rad_fulfillment');
$GLOBALS['RAD_LOG_ENTITIES']['supplierorders'] = array('ptable' => 'tl_rad_supplier_order', 'headerFields' => array('id', 'name', 'tstamp'));
$GLOBALS['RAD_LOG_ENTITIES']['iso_products'] = array('ptable' => 'tl_iso_product', 'headerFields' => array('id', 'name', 'tstamp'));
