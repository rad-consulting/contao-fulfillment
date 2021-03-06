<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */

// Fulfillment
$GLOBALS['TL_DCA']['tl_iso_product']['list']['operations']['log'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['log'],
    'href' => 'table=tl_rad_log',
    'icon' => 'news.gif',
    'button_callback' => array('RAD\\Fulfillment\\Backend\\Button', 'forLog'),
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_ean'] = array(
    'sql' => "varchar(255) NOT NULL default ''",
    'eval' => array('maxlength' => 18, 'unique' => true, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50'),
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_ean'],
    'exclude' => true,
    'default' => array('', 'HE'),
    'options' => array('HE', 'E5', 'EA', 'HK', 'I6', 'IC', 'IE', 'IK', 'SA', 'SG', 'UC', 'VC'),
    'inputType' => 'timePeriod',
    'attributes' => array('legend' => 'dimension_legend', 'singular' => true, 'type' => 'RAD\\Fulfillment\\Model\\Attribute\\EAN'),
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_sku'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_sku'],
    'exclude' => true,
    'search' => true,
    'sorting' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 32, 'rgxp' => 'alnum', 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'fe_sorting' => true, 'fe_search' => true, 'singular' => true),
    'sql' => "varchar(32) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_stock'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_stock'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('rgxp' => 'digit', 'readonly' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'singular' => true),
    'sql' => "int(10) NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_updated'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_updated'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('rgxp' => 'datim', 'readonly' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'singular' => true),
    'sql' => "int(10) NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_export'] = array(
    'eval' => array('includeBlankOption' => true, 'tl_class' => 'w50'),
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_export'],
    'exclude' => true,
    'options' => array('I', 'U', 'D'),
    'reference' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_export.reference'],
    'inputType' => 'select',
    'attributes' => array('legend' => 'export_legend', 'singular' => true),
    'sql' => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_exported'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_exported'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('rgxp' => 'datim', 'readonly' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'singular' => true),
    'sql' => "int(10) NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_unit'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_unit'],
    'exclude' => true,
    'default' => 'PCE',
    'options' => array('PCE', 'PAK', 'PA', 'PK', 'PF', 'PR', 'CR', 'CS', 'CT', 'BO', 'BG'),
    'reference' => &$GLOBALS['TL_LANG']['UNIT'],
    'inputType' => 'select',
    'eval' => array('maxlength' => 32, 'rgxp' => 'alnum', 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'singular' => true),
    'sql' => "char(3) NOT NULL default 'PCE'",
);
