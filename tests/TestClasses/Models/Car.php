<?php

namespace Spatie\ErrorSolutions\Tests\TestClasses\Models;

class Car
{
    public $brand;

    public $color;

    public function __construct($brand, $color)
    {
        $this->brand = $brand;
        $this->color = $color;
    }
}
