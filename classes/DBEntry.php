<?php

/*
  Класс для управления соединения и отправки запросов в БД.
  Конструктор принимает в себя 4 аргумента: название хоста, имя пользователя, пароль, название БД
*/
class DBEntry
{
  private string $hostname;
  private string $username;
  private string $password;
  private string $db;
  private $dbConnection;

  public function __construct($hostname, $username, $password, $db)
  {
    $this->hostname = $hostname;
    $this->username = $username;
    $this->password = $password;
    $this->db = $db;

    $this->dbConnection = mysqli_connect($this->hostname, $this->username, $this->password, $this->db);
  }

  public function __destruct()
  {
    mysqli_close($this->dbConnection);
  }

  // Метод для создания простого запроса в БД
  public function makeQuery($query)
  {
    $this->dbConnection->query($query);
  }

  /*
    Метод для создания запроса для чтения из БД.
    Возвращает ассоциативный массив.
  */
  public function getSelectQueryResult($selectQuery) : array
  {
    $queryResult = mysqli_query($this->dbConnection, $selectQuery);
    $result = [];
    if ($queryResult) {
      while ($rawResult = mysqli_fetch_assoc($queryResult)) {
        $result[] = $rawResult;
      }
    }
    return $result;
  }
}