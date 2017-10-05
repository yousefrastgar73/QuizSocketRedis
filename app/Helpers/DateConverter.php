<?php

namespace App\Helpers;

use App\Http\Requests;

trait DateConverter
{
    function __construct()
    {
//      $this->
    }
  public function getCreatedAtAttribute($value)
    {
        if (! \Request::is('backend/*')) {
            return jdate($value)->format('%B %d، %Y');
        } else {
            return $value;
        }
    }
    public function getUpdatedAtAttribute($value)
    {
        if (! \Request::is('backend/*')) {
            return jdate($value)->format('%B %d، %Y');
        } else {
            return $value;
        }
    }
}
