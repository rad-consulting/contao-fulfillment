<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 */
namespace RAD\Fulfillment\Model\Attribute;

use Contao\Database\Result;
use Isotope\Interfaces\IsotopeProduct;
use Isotope\Isotope;
use Isotope\Model\Attribute;
use RAD\Fulfillment\Model\Product\Fulfillment;

/**
 * Class ValueAndUnit
 */
abstract class ValueAndUnit extends Attribute
{
    /**
     * @const string
     */
    const PROPERTY = 'valueandunit';

    /**
     * @inheritdoc
     */
    public function __construct(Result $result = null)
    {
        $this->arrData['type'] = static::PROPERTY;

        parent::__construct($result);
    }

    /**
     * @inheritdoc
     */
    public function getBackendWidget()
    {
        return $GLOBALS['BE_FFL']['timePeriod'];
    }

    /**
     * @inheritdoc
     */
    public function getFrontendWidget()
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function generate(IsotopeProduct $objProduct, array $arrOptions = array())
    {
        $method = 'get' . ucfirst(static::PROPERTY);

        if (!($objProduct instanceof Fulfillment) || !($instance = $objProduct->$method()) === null) {
            return '';
        }

        return sprintf(
            $arrOptions['format'] ?: '%s %s',
            Isotope::formatPrice($instance->getValue(), false),
            $instance->getUnit()
        );
    }
}
