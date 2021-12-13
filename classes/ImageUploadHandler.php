<?php

class ImageUploadHandler
{
  private array $uploadedImage;
  private string $localDir;

  public function __construct($uploadedImage, $localDir)
  {
    $this->uploadedImage = $uploadedImage;
    $this->localDir = $localDir;
  }

  private function getImageExt()
  {
    $imageNameParse = explode('.', $this->uploadedImage['name']);
    return end($imageNameParse);
  }

  private function getNewImageName()
  {
    return uniqid('', true) . '.' . $this->getImageExt();
  }

  public function getNewImageData()
  {
    $newImageName = $this->getNewImageName();
    return [
      'name' => $this->getNewImageName(),
      'localhost_url' => 'images/' . $newImageName,
      'harddrive_url' => $this->localDir . '/images/' . $newImageName
    ];
  }

  public function uploadImage($newDir) {
    move_uploaded_file($this->uploadedImage['tmp_name'], $newDir);
  }
}