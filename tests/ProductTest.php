<?php

use PHPUnit\Framework\TestCase;

require_once basename(__DIR__) . '/../vendor/autoload.php';
require_once basename(__DIR__) . '/../src/Product.php';

class ProductTest extends TestCase
{
    public function testPrice()
    {
        $product = new Product();
        $product->setPrice(10);
        $this->assertEquals(10, $product->getPrice());
    }
}