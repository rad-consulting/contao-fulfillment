<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Unit\Dimension;

use Haste\Units\Converter;

/**
 * Class Unit
 */
class Unit extends Converter
{
    /**
     * @const string
     */
    const KILOMETER = 'km';
    const MILLIMETER = 'mm';
    const DECIMETER = 'dm';
    const CENTIMETER = 'cm';
    const METER = 'm';

    /**
     * @var array
     */
    protected static $arrFactors = array(
        self::KILOMETER => 0.001,
        self::METER => 1,
        self::DECIMETER => 10,
        self::CENTIMETER => 100,
        self::MILLIMETER => 1000,
    );

    /**
     * @var array
     */
    protected static $iso = array(
        self::KILOMETER => 'KMT',
        self::METER => 'MTR',
        self::DECIMETER => 'DMT',
        self::CENTIMETER => 'CMT',
        self::MILLIMETER => 'MMT',
    );

    /**
     * @return string
     */
    public static function getBase()
    {
        return static::METER;
    }

    /**
     * @param string $noniso
     * @return string
     */
    public static function getISO($noniso)
    {
        return static::$iso[$noniso];
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return array(
            static::MILLIMETER,
            static::CENTIMETER,
            static::DECIMETER,
            static::METER,
            static::KILOMETER,
        );
    }
}
