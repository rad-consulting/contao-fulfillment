<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model\Shipping;

use Contao\Environment;
use Isotope\Model\Shipping\Flat;
use RAD\Fulfillment\Model\Fulfillment;

/**
 * Class Swisspost
 */
class Swisspost extends Flat
{
    /**
     * @return string
     */
    public function getBasicService()
    {
        return $this->arrData['rad_swisspost_basicservice'];
    }

    /**
     * @inheritdoc
     */
    public function backendInterface($orderId)
    {
        $collection = Fulfillment::findByOrder($orderId);
        $tracking = 'n/a';
        $trackings = array();

        if ($collection) {
            foreach ($collection as $item) {
                if ($item instanceof Fulfillment) {
                    $value = $item->getTracking();

                    if (!empty($value)) {
                        $trackings[] = $value;
                    }
                }
            }
        }

        if (count($trackings)) {
            $tracking = '<ul><li>' . implode('</li><li>', $trackings) . '</li></ul>';
        }

        return implode('', array(
            '<div id="tl_buttons"><a href="' . ampersand(str_replace('&key=shipping', '', Environment::get('request'))) . '" class="header_back" title="' . specialchars($GLOBALS['TL_LANG']['MSC']['backBT']) . '">' . $GLOBALS['TL_LANG']['MSC']['backBT'] . '</a></div>',
            '<h2 class="sub_headline">' . $this->name . ' (' . $GLOBALS['TL_LANG']['MODEL']['tl_iso_shipping.' . $this->type][0] . ')' . '</h2>',
            '<div class="tl_formbody_edit"><div class="tl_tbox block">',
            '<p>Track & Trace: ' . $tracking . '</p>',
            '</div></div>',
        ));
    }
}
