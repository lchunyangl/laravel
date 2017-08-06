<?php
/**
 * Created by PhpStorm.
 * User: chunyang
 * Date: 2017/8/5
 * Time: 8:57
 */

namespace App\Exceptions;

use Exception;

class TipsException extends Exception
{
    private $params;
    private $headers;

    public function __construct($message = "", array $params = [], array $headers = [])
    {
        parent::__construct($message);
        $this->params  = $params;
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getParams()
    {
        return $this->params;
    }
}