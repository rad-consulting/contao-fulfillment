<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Unit\EAN;

/**
 * Class Unit
 */
class Unit
{
    /**
     * @const string
     */
    const E5 = 'E5';
    const EA = 'EA';
    const HE = 'HE';
    const HK = 'HK';
    const I6 = 'I6';
    const IC = 'IC';
    const IE = 'IE';
    const IK = 'IK';
    const SA = 'SA';
    const SG = 'SG';
    const UC = 'UC';
    const VC = 'VC';

    /**
     * @return string
     */
    public static function getBase()
    {
        return static::HE;
    }

    /**
     * @return array
     */
    public static function getAll()
    {
        return array(
            static::E5,
            static::EA,
            static::HE,
            static::HK,
            static::I6,
            static::IC,
            static::IE,
            static::IK,
            static::SA,
            static::SG,
            static::UC,
            static::VC,
        );
    }
}
