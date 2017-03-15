<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
namespace RAD\Fulfillment\Unit\TOD;

/**
 * Class TOD
 */
class TOD
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @param string $value
     * @param string $unit
     */
    public function __construct($value, $unit)
    {
        $this->value = $value;
        $this->unit = (string)$unit;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return sprintf($GLOBALS['TL_LANG']['TOD'][$this->getUnit()], $this->getValue());
    }

    /**
     * @return string
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
}
