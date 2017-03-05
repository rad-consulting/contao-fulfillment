<?php
/**
 * Contao extension for RAD Consulting GmbH
 *
 * @copyright  RAD Consulting GmbH 2016
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Backend;

use Contao\Backend;
use Contao\DataContainer;
use Isotope\Model\OrderStatus;
use Isotope\Model\ProductCollection\Order;
use MultiColumnWizard;
use NotificationCenter\Model\Message;
use NotificationCenter\Model\Notification;
use RAD\Fulfillment\Model\Fulfillment;
use RAD\Fulfillment\Model\Product\Fulfillment as Product;

/**
 * Class Panel
 */
class Panel extends Backend
{
    /**
     * @return array
     */
    public function getOptionsForNotification()
    {
        $options = array();
        $collection = Notification::findBy('type', 'fulfillment_status_change');

        if ($collection) {
            foreach ($collection as $item) {
                if ($item instanceof Notification) {
                    $messages = Message::findBy('pid', $item->id);

                    if ($messages) {
                        foreach ($messages as $message) {
                            if ($message instanceof Message) {
                                $options[$message->id] = $message->title;
                            }
                        }
                    }
                }
            }
        }

        asort($options);

        return $options;
    }

    /**
     * @param DataContainer|MultiColumnWizard $dc
     * @return array
     */
    public function getOptionsForProduct($dc)
    {
        if ($dc instanceof MultiColumnWizard) {
            $dc = $dc->dataContainer;
        }

        $type = $dc->activeRecord->producttype;
        $options = array();

        if ($type) {
            $collection = Product::findByType($type, true);
        }
        else {
            $collection = Product::findAll();
        }

        if ($collection) {
            foreach ($collection as $product) {
                if ($product instanceof Product) {
                    $options[$product->getId()] = $product->getName();
                }
            }
        }

        asort($options);

        return $options;
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getOptionsForType(DataContainer $dc)
    {
        $options = array();

        foreach (array_keys(Product::getModelTypes()) as $option) {
            $options[$option] = $GLOBALS['TL_LANG']['MODEL']['tl_iso_product'][$option][0];
        }

        asort($options);

        return $options;
    }

    /**
     * @return array
     */
    public function getOptionsForOrderStatus()
    {
        $options = array();

        $collection = OrderStatus::findAll(array('order' => 'sorting ASC'));

        if ($collection) {
            foreach ($collection as $option) {
                if ($option instanceof OrderStatus) {
                    $options[$option->id] = $option->name;
                }
            }
        }

        return $options;
    }

    /**
     * @param DataContainer $dc
     * @return array
     */
    public function getOptionsForStatus(DataContainer $dc)
    {
        return Fulfillment::getStatus();
    }

    /**
     * @param array $buttons
     * @return array
     */
    public function buttonsForFulfillment(array &$buttons, DataContainer $dc)
    {
        $buffer = array('<div style="margin-top:12px;white-space:nowrap;"><table>');
        $order = Order::findByPk($dc->activeRecord->pid);

        foreach ($order->getItems() as $item) {
            if ($dc->activeRecord->type != $item->type) {
                continue;
            }

            $product = $item->getProduct();

            if ($product instanceof Product) {
                $buffer[] = '<tr><td style="width:20%;padding-right:12px"><input style="max-width:20%" type="text" class="tl_text" disabled="disabled" readonly="readonly" value="' . $product->getSKU() . '"></td><td style="width:20%;padding-right:12px"><input style="max-width:20%" type="text" class="tl_text" disabled="disabled" readonly="readonly" value="' . $product->getEAN()->getValue() . '"></td><td style="width:50%;padding-right:12px"><input type="text" class="tl_text" disabled="disabled" readonly="readonly" value="' . $product->getName() . '"></td><td style="width:10%"><input style="max-width:10%" type="text" class="tl_text" disabled="disabled" readonly="readonly" value="' . $item->quantity . '"></td></tr>';
            }
        }

        $buffer[] = '</table>';

        array_unshift($buttons, '<fieldset id="pal_position_legend" class="tl_box"><legend onclick="AjaxRequest.toggleFieldset(this,\'position_legend\',\'tl_rad_fulfillment\')">Positionen</legend>' . implode('', $buffer) . '</fieldset>');

        return $buttons;
    }
}
