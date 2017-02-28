<?php
/**
 * @copyright  RAD Consulting GmbH 2017
 * @author     Chris Raidler <c.raidler@rad-consulting.ch>
 * @author     Olivier Dahinden <o.dahinden@rad-consulting.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 */
namespace RAD\Fulfillment\Ftp;

use Contao\System;
use RuntimeException;

/**
 * Class Client
 */
class Client
{
    /**
     * @var resource
     */
    protected $stream;

    /**
     * @var bool
     */
    protected $connected = false;

    /**
     * @var bool
     */
    protected $loggedin = false;

    /**
     * @return void
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * @param string $host
     * @param int    $port
     * @param int    $timeout
     * @return $this
     * @throws RuntimeException
     */
    public function connect($host, $port = 21, $timeout = 90)
    {
        $stream = ftp_connect($host, $port, $timeout);

        if (!is_resource($stream)) {
            throw new RuntimeException("Failed to connect to '{$host}:{$port}'");
        }

        $this->stream = $stream;

        return $this;
    }

    /**
     * @return $this
     */
    public function close()
    {
        if (is_resource($this->stream)) {
            ftp_close($this->stream);
            $this->stream = null;
            $this->connected = false;
        }

        return $this;
    }

    /**
     * @param string $remote
     * @return $this
     * @throws RuntimeException
     */
    public function deleteFile($remote)
    {
        if ($this->isLoggedIn()) {
            if (!ftp_delete($this->stream, $remote)) {
                throw new RuntimeException("Failed to delete file '{$remote}'");
            }
        }

        return $this;
    }

    /**
     * @param string $local
     * @param string $remote
     * @param int    $mode
     * @return $this
     * @throws RuntimeException
     */
    public function downloadFile($local, $remote, $mode = FTP_BINARY)
    {
        if ($this->isLoggedIn()) {
            if (false === ftp_get($this->stream, $local, $remote, $mode)) {
                throw new RuntimeException("Failed to download file '{$remote}' to '{$local}'");
            }
        }

        return $this;
    }

    /**
     * @param $username
     * @param $password
     * @return $this
     * @throws RuntimeException
     */
    public function login($username, $password)
    {
        if (!ftp_login($this->stream, $username, $password)) {
            throw new RuntimeException('Failed to login with username/password');
        }
        System::log('logged in with ' . $username . ':' . $password, __METHOD__, TL_CRON);

        $this->loggedin = true;

        return $this;
    }

    /**
     * @param string $remote
     * @param string $local
     * @param int    $mode
     * @return $this
     * @throws RuntimeException
     */
    public function uploadFile($remote, $local, $mode = FTP_BINARY)
    {
        if ($this->isLoggedIn()) {
            if (false === ftp_put($this->stream, $remote, $local, $mode)) {
                throw new RuntimeException("Failed to upload file '{$local}' to '{$remote}'");
            }
        }

        return $this;
    }

    /**
     * @param bool $passive
     * @return $this
     * @throws RuntimeException
     */
    public function setPassive($passive = true)
    {
        if ($this->isConnected()) {
            ftp_pasv($this->stream, $passive);
            System::log('set passive', __METHOD__, TL_CRON);
        }

        return $this;
    }

    /**
     * @return bool
     * @throws RuntimeException
     */
    public function isConnected()
    {
        if (is_resource($this->stream) && $this->connected) {
            return true;
        }

        throw new RuntimeException('Not connected');
    }

    /**
     * @param string $remote
     * @return bool
     * @throws RuntimeException
     */
    public function isFile($remote)
    {
        if ($this->isLoggedIn()) {
            return (bool)ftp_size($this->stream, $remote);
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        return $this->isConnected() && $this->loggedin;
    }
}
