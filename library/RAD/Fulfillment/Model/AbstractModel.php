<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Model;

use Exception;
use Contao\Model;
use RAD\Log\LogInterface;
use RAD\Log\Model\Log;

/**
 * Class AbstractModel
 */
abstract class AbstractModel extends Model implements LogInterface
{
    /**
     * @param string|Exception $message
     * @param int              $level
     * @param string|null      $data
     * @return $this
     */
    public function log($message, $level = Log::INFO, $data = null)
    {
        if ($message instanceof Exception) {
            $level = $message->getCode();
            $message = $message->getMessage();
        }

        Log::factory($this, $message, $level, $data)->save();

        return $this;
    }
}
