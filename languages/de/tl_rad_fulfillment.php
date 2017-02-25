<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */

// Legends
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['type_legend'] = 'Warenausgang';
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['fulfillment_legend'] = 'Kundenbestellung';

// Fields
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['id'] = array('ID');
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['pid'] = array('Bestellung');
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['producttype'] = array('Produkt-Typ');
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['status'] = array('Status');
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['reference'] = array('Referenz', 'Referenz der Kundenbestellung beim Distributeur.');
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['tracking'] = array('Tracking-Nummern', 'Informationen zur Nachverfolgung der Sendung.');

// Reference
$GLOBALS['TL_LANG']['tl_rad_fulfillment']['status.reference'] = array(
    \RAD\Fulfillment\Model\FulfillmentModel::PENDING => 'Pendent',
    \RAD\Fulfillment\Model\FulfillmentModel::SENT => 'Übermittelt',
    \RAD\Fulfillment\Model\FulfillmentModel::CONFIRMED => 'Bestätigt',
    \RAD\Fulfillment\Model\FulfillmentModel::REJECTED => 'Abgelehnt',
    \RAD\Fulfillment\Model\FulfillmentModel::DELIVERED => 'Ausgeliefert',
    \RAD\Fulfillment\Model\FulfillmentModel::COMPLETED => 'Abgeschlossen',
);
