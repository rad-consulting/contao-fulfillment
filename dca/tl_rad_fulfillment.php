<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Config
$GLOBALS['TL_DCA']['tl_rad_fulfillment']['config'] = array(
    'dataContainer' => 'Table',
    'closed' => true,
    'sql' => array(
        'keys' => array(
            'id' => 'primary',
            'pid,ptable,producttype' => 'unique',
        ),
    ),
);

// List
$GLOBALS['TL_DCA']['tl_rad_fulfillment']['list'] = array(
    'sorting' => array(
        'mode' => 2,
        'fields' => array('id DESC'),
        'panelLayout' => 'filter;sort,search,limit',
        'flag' => 12,
    ),
    'label' => array(
        'fields' => array('id', 'tstamp', 'pid', 'producttype', 'status', 'reference', 'tracking'),
        'showColumns' => true,
        'label_callback' => array('RAD\\Fulfillment\\Backend\\Listing', 'listFulfillment'),
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
            'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['log'],
            'href' => 'table=tl_rad_log',
            'icon' => 'news.gif',
            'button_callback' => array('RAD\\Log\\Backend\\Button', 'forLog'),
        ),
        'edit' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['edit'],
            'href' => 'act=edit',
            'icon' => 'edit.gif',
        ),
        'delete' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['delete'],
            'href' => 'act=delete',
            'icon' => 'delete.gif',
            'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
        ),
        'show' => array(
            'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['show'],
            'href' => 'act=show',
            'icon' => 'show.gif',
        ),
    ),
);

// Palettes
$GLOBALS['TL_DCA']['tl_rad_fulfillment']['palettes'] = array(
    'default' => '{type_legend},id,pid,type;{fulfillment_legend},status,reference,tracking',
);

// Fields
$GLOBALS['TL_DCA']['tl_rad_fulfillment']['fields'] = array(
    'id' => array(
        'sql' => "int(10) unsigned NOT NULL auto_increment",
        'eval' => array('readonly' => true),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['id'],
    ),
    'pid' => array(
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'eval' => array('readonly' => true),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['pid'],
    ),
    'ptable' => array(
        'sql' => "varchar(255) NOT NULL default ''",
    ),
    'tstamp' => array(
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['tstamp'],
    ),
    'producttype' => array(
        'sql' => "varchar(48) NOT NULL default 'fulfillment'",
        'eval' => array('readonly' => true),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['producttype'],
        'inputType' => 'select',
        'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForProductType'),
    ),
    'items' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('readonly' => true),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['items'],
    ),
    'tracking' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('maxlength' => 48),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['tracking'],
        'inputType' => 'text',
    ),
    'reference' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('maxlength' => 48),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['reference'],
        'inputType' => 'text',
    ),
    'status' => array(
        'sql' => "int(10) unsigned NOT NULL default '1'",
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['status'],
        'reference' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['status.reference'],
        'inputType' => 'select',
        'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForStatus'),
    ),
);
