<?php

//

namespace openconsult\exceptions;

//

use RuntimeException;

//

class OpenconsultException extends RuntimeException
{
  // messages

  public static $error = [
    1 => 'Not a valid sort',
    2 => 'Not a valid type',
    3 => 'Not a valid integer',
    4 => 'Not a valid array',
    5 => 'Not a valid string',
    6 => 'Not a valid table instance',
    7 => 'Not a valid range',
    8 => 'Not a valid email',
    9 => 'Not a valid username',
    10 => 'Not a valid password',
    11 => 'Not a valid symbol',
    12 => 'Not a valid boolean',
    13 => 'PDO not initialized',
    14 => 'Field cannot be empty',
    15 => 'Field has not been set',
    16 => 'Save cannot be validated',
    17 => 'Limit cannot be validated',
    18 => 'Offset cannot be validated',
    19 => 'Keys cannot be sanitized',
    20 => 'Values cannot be sanitized',
    21 => 'Filter cannot be sanitized',
    22 => 'Search cannot be sanitized',
    23 => 'Order By cannot be sanitized',
    24 => 'Id field doesnt exist',
    25 => 'Array key doesnt exist',
    26 => 'Unable to open file'
  ];

  // constructor

  public function __construct($code, $extra = '')
  {
    if (!empty($code) && is_int($code) && in_array($code, array_keys($this::$error)))
    {
      parent::__construct($this::$error[$code] . (!empty($extra) ? ', ' : '') . $extra, $code);
    }
  }
}
