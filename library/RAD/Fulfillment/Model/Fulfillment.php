<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model;

use Exception, InvalidArgumentException;
use Isotope\Model\ProductCollection\Order as ShopOrder;
use Isotope\Model\ProductCollectionItem as ShopItem;
use Isotope\Model\TypeAgent;
use RAD\Log\LogInterface;
use RAD\Log\Model\Log;

/**
 * Class Fulfillment
 *
 * @property int    $id
 * @property int    $pid
 * @property int    $status
 * @property int    $tstamp
 * @property string $type
 * @property string $ptable
 * @property string $reference
 * @property string $delivery
 * @property string $tracking
 */
class Fulfillment extends TypeAgent implements LogInterface
{
    /**
     * @const int
     */
    const PENDING = 0;
    const SENT = 1;
    const CONFIRMED = 2;
    const REJECTED = 4;
    const DELIVERED = 8;
    const COMPLETED = 16;

    /**
     * @var string
     */
    public static $strTable = 'tl_rad_fulfillment';

    /**
     * @var array
     */
    protected static $arrModelTypes;

    /**
     * @param ShopOrder $order
     * @param string    $type
     * @return static
     */
    public static function factory(ShopOrder $order, $type = 'fulfillment')
    {
        $instance = new static();
        $instance->pid = $order->id;
        $instance->ptable = $order::getTable();
        $instance->status = static::PENDING;
        $instance->tstamp = time();
        $instance->type = $type;

        return $instance;
    }

    /**
     * @param ShopOrder|int $order
     * @return \Model\Collection|null|static
     */
    public static function findByOrder($order)
    {
        if ($order instanceof ShopOrder) {
            $order = $order->id;
        }

        if (!ctype_digit($order)) {
            throw new InvalidArgumentException('Argument must be integer or instance of Isotope\Model\ProductCollection\Order');
        }

        return static::findBy('pid', $order);
    }

    /**
     * @return array
     */
    public static function getStatus()
    {
        return array(
            static::PENDING,
            static::SENT,
            static::CONFIRMED,
            static::REJECTED,
            static::DELIVERED,
            static::COMPLETED,
        );
    }

    /**
     * @return $this
     */
    public function setCompleted()
    {
        $this->status = static::COMPLETED;

        return $this;
    }

    /**
     * @param string|null $reference
     * @param string|null $delivery
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setConfirmed($reference = null, $delivery = null, $message = null, $data = null)
    {
        if ($reference) {
            $this->reference = $reference;
        }

        if ($delivery) {
            $this->delivery = $delivery;
        }

        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->status = static::CONFIRMED;

        return $this;
    }

    /**
     * @param string|null $tracking
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setDelivered($tracking = null, $message = null, $data = null)
    {
        if ($tracking) {
            $this->tracking = $tracking;
        }

        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->status = static::DELIVERED;

        return $this;
    }

    /**
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setRejected($message = null, $data = null)
    {
        if ($message) {
            $this->log($message, Log::WARNING, $data);
        }

        $this->status = static::REJECTED;

        return $this;
    }

    /**
     * @return ShopOrder
     */
    public function getOrder()
    {
        return ShopOrder::findByPk($this->pid);
    }

    /**
     * @return ShopItem[]
     */
    public function getItems()
    {
        return $this->getOrder()->getItems();
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string|null $reference
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setSent($reference = null, $message = null, $data = null)
    {
        if ($reference) {
            $this->reference = $reference;
        }

        if ($message) {
            $this->log($message, Log::INFO, $data);
        }

        $this->status = static::SENT;

        return $this;
    }

    /**
     * @return string
     */
    public function getTracking()
    {
        return $this->tracking;
    }

    /**
     * @param string|Exception $message
     * @param int              $level
     * @param string|null      $data
     * @return $this
     */
    public function log($message, $level = Log::INFO, $data = null)
    {
        if ($message instanceof Exception) {
            $level = $message->getCode();
            $message = $message->getMessage();
        }

        Log::factory($this, $message, $level, $data)->save();

        return $this;
    }
}
