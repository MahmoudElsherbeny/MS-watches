<?php

namespace App\Observers;

use App\Order;
use App\Order_log;

class OrderObserver
{
    protected $except = [
        'created_at',
        'updated_at'
    ];


}
