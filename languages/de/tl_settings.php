<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Legends
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_legend'] = 'Distanzhandel';

// Fields
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_active'] = array('Aktiv', 'Aktivieren oder deaktivieren Sie die Schnittstelle.');
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_orderstatus'] = array('Finaler Bestellungs-Status', 'Wählen Sie hier den Status für Bestellungen, sobald alle Fulfillments ausgeliefert wurden.');
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_notification'] = array('Benachrichtigung', 'Wählen Sie eine Benachrichtigung für neue Fulfillments.');
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery'] = array('Lieferfristen', 'Wählen Sie die Standard-Lieferfristen für den Distanzhandel.');
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.type'] = array('Zustand');
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.unit'] = array('Einheit');
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.value'] = array('Frist');

// References
$GLOBALS['TL_LANG']['tl_settings']['rad_fulfillment_termofdelivery.type.reference'] = array('onstock' => 'An Lager', 'outofstock' => 'Nicht an Lager');
