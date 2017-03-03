<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment;

use Exception;
use Isotope\Model\OrderStatus;
use RAD\Event\EventDispatcher;
use RAD\Event\Model\Event;
use Isotope\Model\ProductCollection\Order;
use RAD\Event\EventSubscriberInterface as EventSubscriber;
use RAD\Fulfillment\Model\Fulfillment;
use RAD\Fulfillment\Model\Product\Fulfillment as Product;

/**
 * Class Service
 */
class Service implements EventSubscriber
{
    /**
     * @var Config
     */
    protected static $config;

    /**
     * @return Config
     */
    public static function getConfig()
    {
        if (empty(static::$config)) {
            static::$config = new Config();
        }

        return static::$config;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        if (static::getConfig()->get('active')) {
            return array(
                'order.create' => 'onCreateOrder',
                'fulfillment.complete' => 'onCompleteFulfillment',
            );
        }

        return array();
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
                $product = Product::findByPk($item->product_id);

                if ($product instanceof Product) {
                    $product->setStock($product->getStock() - $item->quantity);
                    $product->save();
                }
            }
        }
    }

    /**
     * @param Event $event
     * @return void
     */
    public function onCompleteFulfillment(Event $event)
    {
        $model = $event->getSubject();

        if ($model instanceof Fulfillment) {
            $order = $model->getOrder();
            $model->setCompleted()->save();

            $fulfillments = Fulfillment::findBy('pid', $order->getId());

            foreach ($fulfillments as $fulfillment) {
                if ($fulfillment instanceof Fulfillment && Fulfillment::COMPLETED != $fulfillment->status) {
                    return;
                }
            }

            $status = $this->getConfig()->get('orderstatus');

            if (0 < $status) {
                $order->updateOrderStatus($status->id);
            }
        }
    }
}
