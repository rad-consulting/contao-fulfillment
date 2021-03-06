<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
// Palettes
$GLOBALS['TL_DCA']['tl_iso_shipping']['palettes']['swisspost'] = str_replace('{expert_legend:hide}', '{swisspost_legend:hide},rad_swisspost_basicservice;{expert_legend:hide}', $GLOBALS['TL_DCA']['tl_iso_shipping']['palettes']['flat']);

// Fields
$GLOBALS['TL_DCA']['tl_iso_shipping']['fields']['rad_swisspost_basicservice'] = array(
    'sql' => "varchar(24) NOT NULL default 'ECO'",
    'label' => &$GLOBALS['TL_LANG']['tl_iso_shipping']['rad_swisspost_basicservice'],
    'default' => 'ECO',
    'options' => array('ECO', 'PRI', 'APOST', 'APOSTPLUS', 'BPOST', 'RETURN', 'URGENT'),
    'reference' => &$GLOBALS['TL_LANG']['tl_iso_shipping']['rad_swisspost_basicservice.reference'],
    'inputType' => 'select',
);
