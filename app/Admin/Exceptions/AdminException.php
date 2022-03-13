<?php


namespace App\Admin\Exceptions;


use Throwable;

class AdminException extends \Exception
{
    const RESOURCE_NOT_FOUND = 0b1001;

    public function __construct($code = 0)
    {
        parent::__construct("", $code, null);
    }

}
