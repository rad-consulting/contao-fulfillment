<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Fulfillment
$GLOBALS['TL_DCA']['tl_iso_product']['list']['operations']['log'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['log'],
    'href' => 'table=tl_rad_log',
    'icon' => 'news.gif',
    'button_callback' => array('RAD\\Log\\Backend\\Button', 'forLog'),
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_ean'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_ean'],
    'exclude' => true,
    'search' => true,
    'sorting' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 18, 'unique' => true, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'fe_sorting' => true, 'fe_search' => true, 'singular' => true),
    'sql' => "varchar(18) NOT NULL default ''",
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

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_update'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_update'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('rgxp' => 'datim', 'readonly' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'fulfillment_legend', 'singular' => true),
    'sql' => "int(10) NOT NULL default '0'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_length'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_length'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 10, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'dimension_legend', 'singular' => true),
    'sql' => "decimal(8,2) NOT NULL default '0.00'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_width'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_width'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 10, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'dimension_legend', 'singular' => true),
    'sql' => "decimal(8,2) NOT NULL default '0.00'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_height'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_height'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 10, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'dimension_legend', 'singular' => true),
    'sql' => "decimal(8,2) NOT NULL default '0.00'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_volume'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_volume'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array('maxlength' => 10, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50'),
    'attributes' => array('legend' => 'dimension_legend', 'singular' => true),
    'sql' => "decimal(8,2) NOT NULL default '0.00'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_weight'] = array(
    'eval' => array('maxlength' => 10, 'rgxp' => 'digit', 'mandatory' => true, 'tl_class' => 'w50', 'helpwizard' => true),
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_weight'],
    'exclude' => true,
    'default' => array('', 'kg'),
    'options' => array('mg', 'g', 'kg', 't', 'ct', 'oz', 'lb', 'st', 'grain'),
    'reference' => &$GLOBALS['TL_LANG']['WGT'],
    'inputType' => 'timePeriod',
    'attributes' => array('legend' => 'dimension_legend', 'singular' => true, 'type' => 'Isotope\\Model\\Attribute\\Weight'),
    'sql' => "decimal(8,2) NOT NULL default '0.00'",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_export'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_export'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50'),
    'attributes' => array('legend' => 'export_legend', 'singular' => true),
    'sql' => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_iso_product']['fields']['rad_exported'] = array(
    'label' => &$GLOBALS['TL_LANG']['tl_iso_product']['rad_exported'],
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50'),
    'attributes' => array('legend' => 'export_legend', 'singular' => true),
    'sql' => "char(1) NOT NULL default ''",
);
