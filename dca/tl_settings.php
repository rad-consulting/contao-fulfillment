<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Palettes
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{rad_fulfillment_legend},rad_fulfillment_orderstatus,rad_fulfillment_notification,rad_fulfillment_termofdelivery,rad_fulfillment_active;';

// Fields
$GLOBALS['TL_DCA']['tl_settings']['fields']['rad_fulfillment_active'] = array(
    'eval' => array('tl_class' => 'clr'),
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_active'],
    'inputType' => 'checkbox',
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['rad_fulfillment_orderstatus'] = array(
    'eval' => array('tl_class' => 'w50', 'includeBlankOption' => true),
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_orderstatus'],
    'inputType' => 'select',
    'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForOrderStatus'),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['rad_fulfillment_notification'] = array(
    'eval' => array('tl_class' => 'w50', 'includeBlankOption' => true),
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_notification'],
    'inputType' => 'select',
    'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForNotification'),
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['rad_fulfillment_termofdelivery'] = array(
    'sql' => "blob NULL",
    'eval' => array(
        'tl_class' => 'clr',
        'doNotSaveEmpty' => true,
        'disableSorting' => true,
        'columnFields' => array(
            'type' => array(
                'eval' => array('style' => 'width:50px'),
                'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.type'],
                'inputType' => 'select',
                'reference' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.type.reference'],
                'options' => array('onstock', 'outofstock'),
            ),
            'unit' => array(
                'eval' => array('style' => 'width:50px'),
                'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.unit'],
                'inputType' => 'select',
                'reference' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.type.unit'],
                'options' => array('d', 'w', 'm'),
            ),
            'value' => array(
                'eval' => array('rgxp' => 'digit', 'style' => 'width:50px'),
                'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.value'],
                'inputType' => 'text',
            ),
        ),
    ),
    'label' => &$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery'],
    'inputType' => 'multiColumnWizard',
);
