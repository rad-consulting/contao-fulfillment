<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Models
\Isotope\Model\Shipping::registerModelType('swisspost', 'RAD\\Fulfillment\\Model\\Shipping\\Swisspost');
$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\Fulfillment::getTable()] = 'RAD\\Fulfillment\\Model\\Fulfillment';
$GLOBALS['TL_MODELS'][\RAD\Fulfillment\Model\SupplierOrder::getTable()] = 'RAD\\Fulfillment\\Model\\SupplierOrder';

$GLOBALS['ISO_HOOKS']['postCheckout'][] = array('RAD\\Fulfillment\\Service', 'onPostCheckout');
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

$GLOBALS['RAD_LOG_ENTITIES']['fulfillments'] = array(
    'ptable' => 'tl_rad_fulfillment',
);

$GLOBALS['RAD_LOG_ENTITIES']['supplierorders'] = array(
    'ptable' => 'tl_rad_supplier_order',
    'headerFields' => array('id', 'name', 'tstamp'),
);

$GLOBALS['RAD_LOG_ENTITIES']['iso_products'] = array(
    'ptable' => 'tl_iso_product',
    'headerFields' => array('id', 'name', 'tstamp'),
);
