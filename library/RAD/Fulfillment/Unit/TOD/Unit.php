<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
namespace RAD\Fulfillment\Unit\TOD;

/**
 * Class Unit
 */
class Unit
{
    /**
     * @const string
     */
    const DAYS = 'd';
    const WEEKS = 'w';
    const MONTHS = 'm';

    /**
     * @return string
     */
    public static function getBase()
    {
        return static::DAYS;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return array(
            static::DAYS,
            static::WEEKS,
            static::MONTHS,
        );
    }
}
