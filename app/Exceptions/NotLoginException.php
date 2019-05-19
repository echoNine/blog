<?php
/**
 * Created by PhpStorm.
 * User: liuzaisen
 * Date: 2019/5/19
 * Time: 10:09 PM
 */

namespace App\Exceptions;


class NotLoginException extends \Exception {
    protected $message = 'login first';

    protected $code = 401;
}