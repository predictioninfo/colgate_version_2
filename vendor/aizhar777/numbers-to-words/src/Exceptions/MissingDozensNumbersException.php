<?php

namespace Aizhar777\Exceptions;

use Exception;

class MissingDozensNumbersException extends Exception
{
    protected $message = 'Missing dozens in config';
}