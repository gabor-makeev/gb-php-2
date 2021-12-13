<?php

require_once '../vendor/autoload.php';
// Тут происходит подгрузка класса для, который я создал для манипуляций с БД (Задание 1. г))
require_once '../classes/DBEntry.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader);

// Создаю экземпляр класса dbEntry и достаю данные об изображениях из БД
$dbEntry = new DBEntry('localhost', 'root', '', 'gallery');
$images = $dbEntry->getSelectQueryResult("SELECT id, `name`, `url` FROM images;");

// Произвожу рендер шаблона, в который был передан ассоциативный массив с данными об изображениях (Задание 1. в))
try {
  $template = $twig->load('gallery.html.twig');
  echo $template->render([
    'images' => $images,
  ]);
} catch (\Twig\Error\LoaderError|\Twig\Error\SyntaxError|\Twig\Error\RuntimeError $e) {
  echo $e->getMessage();
}
