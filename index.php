<?php

ini_set('display_errors', 1);

use App\Controller\ProductController;
use App\Controller\TestimonialController;
use Core\Env;
use Core\Route;

// Подключение композера
require __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Подключение хелперов
$helpers = glob(
    __DIR__
    . DIRECTORY_SEPARATOR . 'core'
    . DIRECTORY_SEPARATOR . 'Helper'
    . DIRECTORY_SEPARATOR . '*.php'
);
foreach ($helpers as $helper) {
    require_once $helper;
}

// Получение переменных окружения
$_APP_ENV = new Env();

// Роутинг
Route::get('/', ProductController::class);
Route::get('/products', ProductController::class);
Route::get('/products/$id', ProductController::class, 'show');
Route::post('/testimonial/add', TestimonialController::class, 'store');
