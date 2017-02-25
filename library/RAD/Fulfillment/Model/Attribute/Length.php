<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model\Attribute;

use Contao\Database\Result;
use Isotope\Interfaces\IsotopeProduct;
use Isotope\Isotope;
use Isotope\Model\Attribute;
use RAD\Fulfillment\Model\Product\FulfillmentProduct;

/**
 * Class Length
 */
class Length extends Attribute
{
    /**
     * @inheritdoc
     */
    public function __construct(Result $result = null)
    {
        $this->arrData['type'] = 'length';

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
        if (!($objProduct instanceof FulfillmentProduct) || !($length = $objProduct->getLength()) === null) {
            return '';
        }

        return sprintf(
            $arrOptions['format'] ?: '%s %s',
            Isotope::formatPrice($length->getValue(), false),
            $length->getUnit()
        );
    }
}
