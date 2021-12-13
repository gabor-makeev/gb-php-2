<?php
require_once '../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader);

// Получаю изображение, по которому нажал пользователь (Задание 1. б))
$previewImage = $_GET['image'];

// Произвожу вывод рендера шаблона для отображения конкретного изображения (Задание 1. б) / Задание 1. в))
try {
  $template = $twig->load('image_preview.html.twig');
  echo $template->render([
    'previewImage' => $previewImage,
  ]);
} catch (\Twig\Error\LoaderError|\Twig\Error\RuntimeError|\Twig\Error\SyntaxError $e) {
}

