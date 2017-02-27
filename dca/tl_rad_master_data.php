<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Config
$GLOBALS['TL_DCA']['tl_rad_master_data']['config'] = array(
    'dataContainer' => 'Table',
    'sql' => array(
        'keys' => array(
            'id' => 'primary',
        ),
    ),
);

// List
$GLOBALS['TL_DCA']['tl_rad_master_data']['list'] = array(
    'sorting' => array(
        'mode' => 2,
        'fields' => array('id DESC'),
        'panelLayout' => 'filter;sort,search,limit',
        'flag' => 12,
    ),
    'label' => array(
        'fields' => array('id', 'tstamp', 'producttype'),
        'showColumns' => true,
        'label_callback' => array('RAD\\Fulfillment\\Backend\\Listing', 'listMasterData'),
    ),
    'global_operations' => array(
        'back' => array(
            'label' => &$GLOBALS['TL_LANG']['MSC']['backBT'],
            'href' => 'mod=&table=',
            'class' => 'header_back',
            'attributes' => 'onclick="Backend.getScrollOffset();"',
        ),
    ),
    'operations' => array(
        'log' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_g4g_event']['log'],
            'href' => 'table=tl_rad_log',
            'icon' => 'news.gif',
            'button_callback' => array('RAD\\Log\\Backend\\Button', 'forLog'),
        ),
        'edit' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['edit'],
            'href' => 'act=edit',
            'icon' => 'edit.gif',
        ),
        'delete' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['delete'],
            'href' => 'act=delete',
            'icon' => 'delete.gif',
            'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
        ),
        'show' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['show'],
            'href' => 'act=show',
            'icon' => 'show.gif',
        ),
    ),
);

// Palettes
$GLOBALS['TL_DCA']['tl_rad_master_data']['palettes'] = array(
    'default' => '{type_legend},producttype;{export_legend},export,exported;',
);

// Fields
$GLOBALS['TL_DCA']['tl_rad_master_data']['fields'] = array(
    'id' => array(
        'sql' => "int(10) unsigned NOT NULL auto_increment",
        'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['id'],
    ),
    'tstamp' => array(
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['tstamp'],
    ),
    'producttype' => array(
        'sql' => "varchar(64) NOT NULL default 'standard'",
        'eval' => array('tl_class' => 'w50', 'unique' => true, 'submitOnChange' => true),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['producttype'],
        'default' => 'standard',
        'inputType' => 'select',
        'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForProductType'),
    ),
    'export' => array(
        'sql' => "char(1) NOT NULL default '0'",
        'eval' => array('tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['export'],
        'inputType' => 'checkbox',
    ),
    'exported' => array(
        'sql' => "char(1) NOT NULL default '0'",
        'eval' => array('tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_master_data']['exported'],
        'inputType' => 'checkbox',
    ),
);
