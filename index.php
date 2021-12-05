<?php

// Задание 1, 2, 3

class Product
{
  protected $id; // id, соответствующий id из базы данных
  protected $name; // название товара
  protected $description; // описание товара
  protected $price; // цена товара
  protected $isAvailable; // свойство описывающее то, есть ли товар в наличии
  protected $discount; /* свойство, хранящее в себе статус скидки на товар.
    $discount['state'] - true/false, указывает на то действует ли скидка.
    $discount['size'] - int, указывает размер скидки.
  */

  public function __construct($id, $name, $description, $price)
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
    $this->isAvailable = true;
    $this->discount = [
      'state' => false,
      'size' => 0
    ];
  }

  /* 
    метод toggleAvailabilityState() меняет значение свойства isAvailable на противоположное.
    (Есть в наличии / Нет в наличии)
  */
  protected function toggleAvailabilityState()
  {
    $this->isAvailable = !$this->isAvailable;
  }

  /* 
    getAvailabilityState() - просто возвращает текущее значение свойства isAvailable.
    Далее можно заметить методы: setName(), setPrice(), setDescription(), getName(), getPrice(),
    getDescription(). Их цель в том, чтобы не приходилось обращатся к определенным свойствам класса
    прямо, а также лучше контролировать то как они меняются. Например, в будущем, можно добавить
    дополнительные проверки на то, на какое значение меняется то или инное свойство в рамках вызова
    определенного метода.
  */
  public function getAvailabilityState()
  {
    return $this->isAvailable;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setPrice($price)
  {
    $this->price = $price;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getPrice()
  {
    return $this->price;
  }


  //  метод removeDiscount() снимает скидку с товара
  public function removeDiscount()
  {
    if ($this->discount['state']) {
      $this->setPrice(($this->price * 100) / (100 - $this->discount['size']));
      $this->discount['state'] = false;
      $this->discount['size'] = 0;
    }
  }

  /* 
    метод makeDiscount() накладывает на товар скидку. Принимает int аргумент, например,
    10, если цель - наложить скидку в 10%.
  */
  public function makeDiscount($discountPercent)
  {
    if ($this->discount['state']) {
      $this->removeDiscount();
      $this->makeDiscount($discountPercent);
    } else {
      $this->discount['state'] = true;
      $this->discount['size'] = $discountPercent;
      $this->setPrice($this->price * (1 - ($discountPercent / 100)));
    }
  }
}

// Задание 4

// PC - один из наследников класса Product, он отвечает за товары категории "Персональные компьютеры"
class PC extends Product
{
  protected $manufacturer; // производитель компьютера
  protected $cpu; // свойство хранящее название процессора данного ПК
  protected $gpu; // свойство харнящее название графического процессора данного ПК
  private $isProduced; /* приватное свойство isProduced хранит информацию о том производится ли еще
    данная модель ПК.
  */

  public function __construct($id, $name, $description, $price, $manufacturer, $cpu, $gpu)
  {
    parent::__construct($id, $name, $description, $price);
    $this->manufacturer = $manufacturer;
    $this->cpu = $cpu;
    $this->gpu = $gpu;
    $this->isProduced = true;
  }

  /* 
    метод changeProductionState() меняет значение поля isProduced на обратное - true/false
    (Производится / Снят с производства)
  */
  public function changeProductionState()
  {
    $this->isProduced = !$this->isProduced;
  }

  // метод getProductionState() возвращает текущее значение свойства isProduced
  public function getProductionState()
  {
    return $this->isProduced;
  }

  public function setManufacturer($manufacturer)
  {
    $this->manufacturer = $manufacturer;
  }
  public function setCPU($cpu)
  {
    $this->cpu = $cpu;
  }
  public function setGPU($gpu)
  {
    $this->gpu = $gpu;
  }

  public function getManufacturer()
  {
    return $this->manufacturer;
  }

  public function getCPU()
  {
    return $this->cpu;
  }

  public function getGPU()
  {
    return $this->gpu;
  }
}

/* 
  главное отличие класса PC от класса Product заключается в том, что у класса PC присутствует
  свойство isProduced, следовательно и логическая способность к тому чтобы производится либо не
  производится.
*/

class Keyboard extends Product
{
  protected $manufacturer; // производитель клавиатуры
  protected $type; // тип клавиатуры (механическая / мембранная)
  protected $connectionType; /* тип соединения с клавиатурой 
    (проводное / беспроводное / комбинированное) 
  */

  public function __construct($id, $name, $description, $price, $manufacturer, $type, $connectionType)
  {
    parent::__construct($id, $name, $description, $price);
    $this->manufacturer = $manufacturer;
    $this->type = $type;
    $this->connectionType = $connectionType;
  }

  public function setManufacturer($manufacturer)
  {
    $this->manufacturer = $manufacturer;
  }

  public function setType($type)
  {
    $this->type = $type;
  }

  public function setConnectionType($connectionType)
  {
    $this->connectionType = $connectionType;
  }

  public function getManufacturer()
  {
    return $this->manufacturer;
  }

  public function getType()
  {
    return $this->type;
  }

  public function getConnectionType()
  {
    return $this->connectionType;
  }
}

/* 
  класс Keyboard отличается от своего класса родителя (Product) исключительно наличием дополнительных,
  таких как manufacturer, type, connectionType.
*/

// Задание 5
// Дан код: (Что он выведет на каждом шаге? Почему?)

// class A
// {
//   public function foo()
//   {
//     static $x = 0;
//     echo ++$x;
//   }
// }
// $a1 = new A();
// $a2 = new A();
// $a1->foo(); // >> 1
/* 
  Так как используется оператор преинкремента, значение переменной $x увеличевается на 1,
  а затем выводится.
*/
// $a2->foo(); // >> 2 
/* 
  так как переменная $x является статичной, она принадлежит не конкретному экземпляру, 
  а самому классу от которого этот экземпляр был инциализирован. 
  Так что, вне зависимости от того, от которого экземпляра класса A вызывается метод foo(), 
  он будет продолжать увеличивать значение переменной $x на 1 при каждом вызове.
*/
// $a1->foo(); // >> 3
// $a2->foo(); // >> 4

// Задание 6
// Немного изменим п.5: (Объясните результаты в этом случае.)

// class A
// {
//   public function foo()
//   {
//     static $x = 0;
//     echo ++$x;
//   }
// }
// class B extends A
// {
// }
// $a1 = new A();
// $b1 = new B();
// $a1->foo(); // >> 1
// $b1->foo(); // >> 1
// $a1->foo(); // >> 2
// $b1->foo(); // >> 2

/* 
  Во время наследование, класс B использует свой собственный набор статичных переменных.
  Даже если статическая переменная декларируется в рамках определенного метода класса родителя,
  во время вызова, она декларируется как отдельная статическая переменная 
  на уровне каждого класса отдельно - у родителя и каждого его потомка.

  В данном случае это переменная $x, которая будет увеличиватся отдельно во время вызова функции foo()
  у экземпляров класса A, а также отдельно у экземпляров класса B.
*/

// Задание 7
// *Дан код: (Что он выведет на каждом шаге? Почему?)

// class A {
//   public function foo() {
//       static $x = 0;
//       echo ++$x;
//   }
// }
// class B extends A {
// }
// $a1 = new A;
// $b1 = new B;
// $a1->foo(); // >> 1
// $b1->foo(); // >> 1
// $a1->foo(); // >> 2
// $b1->foo(); // >> 2

/* 
  Результат выполнения данного кода будет идентичным тому, что был представлен в примере из задании 6.
  Разница только в том, что при создании экземляров круглые скобки были упущены.
  Наличие скобок является наобходимым только в том случае если есть необходимость в передаче
  аргументов конструктору класса. Также, отсутствие круглых скобок - дурной тон.
*/