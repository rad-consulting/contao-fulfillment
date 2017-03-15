<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
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

        $template->getEAN = function () use ($product) {
            if ($product instanceof Fulfillment) {
                return $product->getEAN();
            }

            return null;
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

        $template->getTOD = function () use ($product) {
            if ($product instanceof Fulfillment) {
                return $product->getTOD();
            }

            return null;
        };
    }
}
