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
            'pid,ptable,type' => 'unique',
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
        'fields' => array('id', 'tstamp', 'pid', 'type', 'status', 'reference', 'delivery'),
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
    '__selector__' => array('type'),
    'default' => '{type_legend},id,pid,type,status;{fulfillment_legend},reference,tracking;{position_legend},positions',
);

// Fields
$GLOBALS['TL_DCA']['tl_rad_fulfillment']['fields'] = array(
    'id' => array(
        'sql' => "int(10) unsigned NOT NULL auto_increment",
        'eval' => array('readonly' => true, 'tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['id'],
        'inputType' => 'text',
    ),
    'pid' => array(
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'eval' => array('readonly' => true, 'tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['pid'],
        'inputType' => 'text',
    ),
    'ptable' => array(
        'sql' => "varchar(255) NOT NULL default ''",
    ),
    'tstamp' => array(
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['tstamp'],
    ),
    'type' => array(
        'sql' => "varchar(48) NOT NULL default 'fulfillment'",
        'eval' => array('disabled' => true, 'tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['type'],
        'filter' => true,
        'inputType' => 'select',
        'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForType'),
    ),
    'items' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('readonly' => true),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['items'],
    ),
    'tracking' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('maxlength' => 48, 'tl_class' => 'clr'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['tracking'],
        'inputType' => 'text',
    ),
    'reference' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('maxlength' => 48, 'tl_class' => 'w50'),
        'search' => true,
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['reference'],
        'inputType' => 'text',
    ),
    'delivery' => array(
        'sql' => "varchar(48) NOT NULL default ''",
        'eval' => array('maxlength' => 48, 'tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['delivery'],
        'search' => true,
        'inputType' => 'text',
    ),
    'status' => array(
        'sql' => "int(10) unsigned NOT NULL default '1'",
        'eval' => array('tl_class' => 'w50'),
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['status'],
        'filter' => true,
        'reference' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['status.reference'],
        'inputType' => 'select',
        'options_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'getOptionsForStatus'),
    ),
    'positions' => array(
        'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['positions'],
        'inputType' => 'multiColumnWizard',
        'load_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'loadForPositions'),
        'save_callback' => array('RAD\\Fulfillment\\Backend\\Panel', 'saveForPositions'),
        'eval' => array(
            'tl_class' => 'clr',
            'doNotSaveEmpty' => true,
            'disableSorting' => true,
            'columnFields' => array(
                'sku' => array(
                    'eval' => array('style' => 'width:50px'),
                    'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['sku'],
                    'inputType' => 'text',
                ),
                'ean' => array(
                    'eval' => array('style' => 'width:50px'),
                    'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['ean'],
                    'inputType' => 'text',
                ),
                'product' => array(
                    'eval' => array('style' => 'width:250px'),
                    'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['product'],
                    'inputType' => 'text',
                ),
                'quantity' => array(
                    'eval' => array('style' => 'width:50px'),
                    'label' => &$GLOBALS['TL_LANG']['tl_rad_fulfillment']['quantity'],
                    'inputType' => 'text',
                ),
            ),
        ),
    ),
);
