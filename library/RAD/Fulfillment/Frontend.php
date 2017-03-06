<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment;

use Contao\Frontend as ContaoFrontend;
use Isotope\Model\Product;
use Isotope\Template;
use RAD\Fulfillment\Model\Product\Fulfillment;

/**
 * Class Frontend
 */
class Frontend extends ContaoFrontend
{
    /**
     * @param Template $template
     * @param Product  $product
     * @return void
     */
    public function onGenerateProduct(Template $template, Product $product)
    {
        $template->isAvailable = function () use ($product) {
            if ($product instanceof Fulfillment) {
                return (bool)$product->getStock();
            }

            return true;
        };

        $template->getDelivery = function () use ($product) {

        };

        $template->getStock = function () use ($product) {
            if ($product instanceof Fulfillment) {
                return $product->getStock();
            }

            return 0;
        };

        $template->hasStock = function () use ($product) {
            if ($product instanceof Fulfillment) {
                return (bool)$product->getStock();
            }

            return true;
        };
    }
}
