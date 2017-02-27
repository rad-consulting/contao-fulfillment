<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model\Shipping;

use Isotope\Model\Shipping\Flat;

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
}
