<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;

require_once '../vendor/autoload.php';

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, []);
$filter = new TwigFilter('myCustomFilter', function ($string) {
    return str_rot13($string) . '___email';
});

$twig->addFilter($filter);
$twig->addGlobal('title', 'Global title');

$users = [
    [
        'name' => 'gabor',
        'email' => 'gabor@gabor.com'
    ],
    [
        'name' => '<p>gabor 2</p>',
        'email' => 'gabor2@gabor.com'
    ],
    [
        'name' => 'gabor 3',
        'email' => 'gabor3@gabor.com'
    ]
];
try {
    try {
        $template = $twig->load('index.htmlChild.twig');
        echo $template->render([
            'users' => $users
        ]);
    }
    catch (\Exception $exception) {
//        echo $exception->getMessage();
//        var_dump($exception->getTraceAsString());
        throw new Exception('Something went wrong');
    }
}
catch (\Exception $e) {
    echo $e->getMessage();
}