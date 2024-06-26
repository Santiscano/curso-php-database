<?php

require("../vendor/autoload.php");

use App\Controllers\IncomesController;
use App\Controllers\WithdrawalController;
use Router\RouterHandler;

// obtener la URL
$slug = $_GET['slug'] ?? '/';
$slug = explode('/', $slug);


$resourse = $slug[0] == "" ? "/" : $slug[0];
$id = $slug[1] ?? null;
// incomes/1

// instancia del router
$router = new RouterHandler();

switch ($resourse) {
  case '/':
    echo "estas en Home";
    // $controller = new App\Controllers\HomeController();
    // $controller->index();
    break;

  case 'incomes':
    $method = $_POST['_method'] ?? 'POST';
    $router->set_method($method);
    $router->set_data($_POST);
    $router->route(IncomesController::class, $id);
    // $controller = new App\Controllers\IncomeController();
    // if ($id) {
    //   $controller->show($id);
    // } else {
    //   $controller->index();
    // }
    break;

  case 'withdrawals':
    $method = $_POST['_method'] ?? 'POST';
    $router->set_method($method);
    $router->set_data($_POST);
    $router->route(WithdrawalController::class, $id);
    // $controller = new App\Controllers\WithdrawalController();
    // if ($id) {
    //   $controller->show($id);
    // } else {
    //   $controller->index();
    // }
    break;
  default:
    echo "404 Not Found";
    break;
}
