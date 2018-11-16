<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $categoryid;
    public $path;
    public $price;
    public $qty;
    public $name;

    public function __construct() {}
}
