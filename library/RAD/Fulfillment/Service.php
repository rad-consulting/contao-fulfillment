<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment;

use Exception;
use RAD\Event\EventDispatcher;
use RAD\Event\Model\EventModel as Event;
use Isotope\Model\ProductCollection\Order;
use RAD\Event\EventSubscriberInterface as EventSubscriber;
use RAD\Fulfillment\Model\Product\FulfillmentProduct;

/**
 * Class Service
 */
class Service implements EventSubscriber
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'order.create' => 'onCreateOrder',
        );
    }

    /**
     * @param Order $order
     * @return void
     */
    public function onPostCheckout(Order $order)
    {
        EventDispatcher::getInstance()->dispatch('order.create', $order);
    }

    /**
     * @param Event $event
     * @return void
     * @throws Exception
     */
    public function onCreateOrder(Event $event)
    {
        $order = $event->getSubject();

        if ($order instanceof Order) {
            foreach ($order->getItems() as $item) {
                $product = FulfillmentProduct::findByPk($item->product_id);

                if ($product instanceof FulfillmentProduct) {
                    $product->setStock($product->getStock() + $item->quantity);
                    $product->save();
                }
            }
        }
    }
}
