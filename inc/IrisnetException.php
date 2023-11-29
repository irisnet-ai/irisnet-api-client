<?php
/**
 * @package IrisnetAPIClient
 */
namespace Inc;

class IrisnetException extends \Exception
{
    public function __construct($message = "", $code = 0)
    {
        parent::__construct($message, $code);
    }
}
