<?php

/* Задание 1. Создать структуру классов ведения товарной номенклатуры.
 * а) Есть абстрактный товар.
 * б) Есть цифровой товар, штучный физический товар и товар на вес.
 * в) У каждого есть метод подсчета финальной стоимости.
 * г) У цифрового товара стоимость постоянная – дешевле штучного товара в два раза. У штучного товара обычная стоимость, у весового – в зависимости от продаваемого количества в килограммах. У всех формируется в конечном итоге доход с продаж.
 * д) Что можно вынести в абстрактный класс, наследование?
*/

abstract class Product
{
    protected $value;
    /*
        Входные данные о стоимости товара назвал value,
        чтобы избежать недопониманий между терминами value и price
    */
    public function __construct($value)
    {
        $this->value = $value;
    }

    abstract public function getFinalPrice();
}

class PieceProduct extends Product // PieceProduct = штучный товар
{
    public function getFinalPrice()
    {
        return $this->value;
    }
}

class DigitalProduct extends Product // DigitalProduct = цифровой товар
{
    public function getFinalPrice()
    {
        return $this->value / 2;
        /*
            Альтернативное решение:
            return ((new PieceProduct($this->value))->getFinalPrice()) / 2;
        */
    }
}

class WeightedProduct extends Product // WeightedProduct = товар на вес
{
    private $weight;

    public function __construct($value, int $weight)
    {
        parent::__construct($value);
        $this->weight = $weight;
    }

    public function getFinalPrice()
    {
        return $this->weight * $this->value;
    }
}

// Проверка созданных классов:
$digitalProduct = new DigitalProduct(100);
echo $digitalProduct->getFinalPrice() . PHP_EOL;

$weightedProduct = new WeightedProduct(100, 2);
echo $weightedProduct->getFinalPrice() . PHP_EOL;

$pieceProduct = new PieceProduct(100);
echo $pieceProduct->getFinalPrice();

// Задание 2. *Реализовать паттерн Singleton при помощи traits.

trait SingletonModifier
{
    protected static $instance;

    protected function __construct()
    {
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            return new self();
        }
        return self::$instance;
    }

    protected function __clone()
    {
    }

    protected function __sleep()
    {
    }

    protected function __wakeup()
    {
    }
}

class A
{
    use SingletonModifier;
}

