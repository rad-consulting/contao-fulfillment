<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model;

use Isotope\Model\ProductCollection\Order;
use RAD\Log\Model\LogModel as Log;

/**
 * Class FulfillmentModel
 *
 * @property int    $id
 * @property int    $pid
 * @property int    $status
 * @property int    $tstamp
 * @property string $type
 * @property string $ptable
 * @property string $reference
 * @property string $tracking
 */
class FulfillmentModel extends AbstractModel
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
     * @param Order  $order
     * @param string $type
     * @return static
     */
    public static function factory(Order $order, $type = 'fulfillment')
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
     * @param string|null $message
     * @param string|null $data
     * @return $this
     */
    public function setConfirmed($reference = null, $message = null, $data = null)
    {
        if ($reference) {
            $this->reference = $reference;
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
            $this->log($message, Log::INFO, $data);
        }

        $this->status = static::REJECTED;

        return $this;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return Order::findByPk($this->pid);
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
}
