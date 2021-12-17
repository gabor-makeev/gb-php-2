<?php
/*В файле DBEntry.php находится описание класса для работы с базой данных.
Также в данном файле можна найти функцию getRandomWord() и fillDbWithFakeData(),
  которые я создал для более удобного наполнения базы рандомными данными.*/
class DBEntry
{
  private string $hostname;
  private string $user;
  private string $password;
  private string $db;
  private mysqli $connection;

  public function __construct($hostname, $user, $password, $db)
  {
    $this->hostname = $hostname;
    $this->user = $user;
    $this->password = $password;
    $this->db = $db;
    $this->connection = mysqli_connect($this->hostname, $this->user, $this->password, $this->db);
  }

  public function __destruct()
  {
    mysqli_close($this->connection);
  }

  private function makeQuery(string $string)
  {
    $this->connection->query($string);
  }

  private function getRandomWord(): string
  {
    $letters = range('a', 'z');
    $wordArr = [];
    for ($i = 0; $i <= 5; $i++) {
      $randomLetter = $letters[rand(0, count($letters) - 1)];
      $wordArr[] = $randomLetter;
    }
    return implode($wordArr);
  }

  public function fillDbWithFakeData($recordNumber)
  {
    for ($record = 0; $record < $recordNumber; $record++) {
      $name = $this->getRandomWord();
      $price = rand(100, 1000);
      $query = "INSERT INTO products (name, price) VALUES ('$name', $price);";
      $this->makeQuery($query);
    }
  }

  public function makeSelectQuery(string $selectQuery) : array
  {
    $query = mysqli_query($this->connection, $selectQuery);
    $result = [];
    while($record = mysqli_fetch_assoc($query)) {
      $result[] = $record;
    }
    return $result;
  }
}