<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RADTest\Fulfillment;

use Isotope\Model\ProductCollection\Order;
use PHPUnit\Framework\TestCase;
use RAD\Fulfillment\Service;

/**
 * Class FulfillmentTest
 */
class FulfillmentTest extends TestCase
{
    /**
     * @var int
     */
    protected $id = 7;

    /**
     * @return void
     */
    public function testOnPostCheckout()
    {
        $order = Order::findByPk($this->id);
        $service = new Service();
        $service->onPostCheckout($order);
    }
}
