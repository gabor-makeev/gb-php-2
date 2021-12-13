<?php

/*
  Тут происходит подгрузка классов для работы с БД (dbEntry)
  и обработки подгружаемого изображения (ImageUploadHandler).
*/
require_once '../classes/DBEntry.php';
require_once '../classes/ImageUploadHandler.php';

$uploadedImage = $_FILES['user_image'];

$dbEntry = new DBEntry('localhost', 'root', '', 'gallery');
$imageUploadHandler = new ImageUploadHandler($uploadedImage, __DIR__);

$newImageData = $imageUploadHandler->getNewImageData();

// Далее происходит загрузка изображения в директорию images
$imageUploadHandler->uploadImage($newImageData['harddrive_url']);
// Тут происходит создание новой записи в БД
$dbEntry->makeQuery("INSERT INTO images (`name`, `url`) VALUES ('" . $newImageData['name'] ."', '" . $newImageData['localhost_url'] ."')");

header('Location: index.php');