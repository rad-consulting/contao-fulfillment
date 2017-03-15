<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
namespace RAD\Fulfillment;

use ArrayObject;
use Contao\Config as Settings;

/**
 * Class Config
 */
class Config extends ArrayObject
{
    /**
     * @var string
     */
    protected $prefix = 'rad_fulfillment_';

    /**
     * @param string     $name
     * @param mixed|null $default
     * @return mixed|null
     */
    public function get($name, $default = null)
    {
        return $this->offsetExists($name) ? $this->offsetGet($name) : $default;
    }

    /**
     * @param mixed $index
     * @return bool
     */
    public function offsetExists($index)
    {
        if (!parent::offsetExists($index)) {
            parent::offsetSet($index, Settings::get($this->prefix . $index));
        }

        return parent::offsetExists($index);
    }
}
