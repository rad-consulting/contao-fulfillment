<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Legends
$GLOBALS['TL_LANG']['tl_iso_product']['fulfillment_legend'] = 'Distanzhandel';
$GLOBALS['TL_LANG']['tl_iso_product']['dimension_legend'] = 'Dimensionen';
$GLOBALS['TL_LANG']['tl_iso_product']['export_legend'] = 'Export';

// Fields
$GLOBALS['TL_LANG']['tl_iso_product']['rad_ean'] = array('EAN', 'European Article Number');
$GLOBALS['TL_LANG']['tl_iso_product']['rad_sku'] = array('SKU', 'SKU des Produkts beim Lieferanten.');
$GLOBALS['TL_LANG']['tl_iso_product']['rad_stock'] = array('Lagerbestand', 'Lagerbestand des Produkts beim Lieferanten.');
$GLOBALS['TL_LANG']['tl_iso_product']['rad_updated'] = array('Synchronisation', 'Letzte Synchronisation des Produktes mit dem Lieferanten.');
$GLOBALS['TL_LANG']['tl_iso_product']['rad_export'] = array('Exportieren', 'Export-Modus an Schnittstellen.');
$GLOBALS['TL_LANG']['tl_iso_product']['rad_exported'] = array('Exportiert', 'Letzter Export an Schnittstellen.');
$GLOBALS['TL_LANG']['tl_iso_product']['rad_unit'] = array('Verkaufseinheit', 'Wählen Sie die richtige Verkaufseinheit.');

// References
$GLOBALS['TL_LANG']['tl_iso_product']['rad_export.reference'] = array(
    'I' => 'Anlegen (INSERT)',
    'U' => 'Aktualisieren (UPDATE)',
    'D' => 'Löschen (DELETE)',
);

$GLOBALS['TL_LANG']['UNIT'] = array(
    'PCE' => 'Stück (PCE)',
    'PAK' => 'Pack (PAK)',
    'PA' => 'Paket (PA)',
    'PK' => 'Packen (PK)',
    'PF' => 'Palette (PF)',
    'PR' => 'Paar (PR)',
    'CR' => 'Kiste (CR)',
    'CS' => 'Kasten (CS)',
    'CT' => 'Karton (CT)',
    'BO' => 'Flasche (BO)',
    'BG' => 'Tüte (BG)',
);
