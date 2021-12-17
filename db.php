<?php

/*
 * Файл db.php предназначен для предоставления ответов на get-запросы от
 * скрипта из index.php. Также, в данном файле производится проверка базы на наличие данных
 * в таблице products. В случае отсутствия данных - начнется наполнение базы 100 искуственных записей.
*/

require_once 'classes/DBEntry.php';

$DBEntry = new DBEntry('localhost', 'root', '', 'shop');

// Проверка базы на наличие данных
if (!$DBEntry->makeSelectQuery('SELECT * FROM products WHERE 1;')) {
  $DBEntry->fillDbWithFakeData(100);
}

/*
  Проверка типа обращения к db.php.
  В случае если get-параметр не был указан - db.php ответит сообщением
  о том, сколько записей находится в базе. Данная возможность мне была необходима
  для корректной работы кнопки "Еще"
*/
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  $rowNumber = $page * 25;

  $productPageContent = $DBEntry->makeSelectQuery("SELECT id, name, price FROM products WHERE 1 LIMIT 0, $rowNumber");

  header('Content-Type: application/json');
  echo json_encode($productPageContent);
} else {
  $productCount = $DBEntry->makeSelectQuery("SELECT COUNT(*) as 'count' FROM products WHERE 1");
  header('Content-Type: application/json');
  echo json_encode($productCount);
}