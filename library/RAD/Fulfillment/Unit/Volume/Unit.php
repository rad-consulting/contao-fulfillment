<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Unit\Volume;

use Haste\Units\Converter;

/**
 * Class Unit
 */
class Unit extends Converter
{
    /**
     * @const string
     */
    const CUBICMETER = 'm3';
    const CUBICDECIMETER = 'dm3';
    const CUBICCENTIMETER = 'cm3';
    const CUBICMILLIMETER = 'mm3';

    /**
     * @var array
     */
    protected static $arrFactors = array(
        self::CUBICMETER => 0.000001,
        self::CUBICDECIMETER => 0.001,
        self::CUBICCENTIMETER => 1,
        self::CUBICMILLIMETER => 1000,
    );

    /**
     * @var array
     */
    protected static $iso = array(
        self::CUBICMETER => 'MTQ',
        self::CUBICDECIMETER => 'DMQ',
        self::CUBICCENTIMETER => 'CMQ',
        self::CUBICMILLIMETER => 'MMT',
    );

    /**
     * @return string
     */
    public static function getBase()
    {
        return static::CUBICCENTIMETER;
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
            static::CUBICMILLIMETER,
            static::CUBICCENTIMETER,
            static::CUBICDECIMETER,
            static::CUBICMETER,
        );
    }
}
