<?php

namespace Aizhar777\Exceptions;

use Exception;

class MissingTwentyNumbersException extends Exception
{
    protected $message = 'Missing twenty in config';
}