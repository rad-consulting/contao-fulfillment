<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Palettes
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{rad_fufillment_legend},rad_fulfillment_orderstatus,rad_fulfillment_active;';

// Fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['rad_fulfillment_active'] = array(
    'eval' => array('tl_class' => 'clr'),
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_active'],
    'inputType' => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['rad_fulfillment_orderstatus'] = array(
    'eval' => array('tl_class' => 'w50'),
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_orderstatus'],
    'inputType' => 'select',
    'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForOrderStatus'),
);
