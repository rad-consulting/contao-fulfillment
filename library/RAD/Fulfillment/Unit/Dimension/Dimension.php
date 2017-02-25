<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Unit\Dimension;

/**
 * Class Dimension
 */
class Dimension
{
    /**
     * @var float
     */
    protected $value;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @param float  $value
     * @param string $unit
     */
    public function __construct($value, $unit)
    {
        $this->value = $value;
        $this->unit = (string)$unit;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $data
     * @return Dimension|null
     */
    public static function createFromTimePeriod($data)
    {
        $data = deserialize($data);

        if (empty($data) || !is_array($data) || $data['value'] === '' || $data['unit'] === '' || !in_array($data['unit'], Unit::getAll())) {
            return new static(0, Unit::getBase());
        }

        return new static($data['value'], $data['unit']);
    }
}
