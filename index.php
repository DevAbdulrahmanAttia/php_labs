<?php

require_once __DIR__ . '/core/Autoloader.php';

use Core\Router;
use Core\Session;

Session::start();

$router = new Router();

// Auth routes
$router->register('auth/login',    [Controllers\AuthController::class, 'login']);
$router->register('auth/logout',   [Controllers\AuthController::class, 'logout']);
$router->register('auth/register', [Controllers\AuthController::class, 'register']);
$router->register('auth/store',    [Controllers\AuthController::class, 'store']);

// Employee routes
$router->register('employee/list',   [Controllers\EmployeeController::class, 'index']);
$router->register('employee/create', [Controllers\EmployeeController::class, 'create']);
$router->register('employee/store',  [Controllers\EmployeeController::class, 'store']);
$router->register('employee/view',   [Controllers\EmployeeController::class, 'view']);
$router->register('employee/edit',   [Controllers\EmployeeController::class, 'edit']);
$router->register('employee/update', [Controllers\EmployeeController::class, 'update']);
$router->register('employee/delete', [Controllers\EmployeeController::class, 'delete']);

$route = $_GET['route'] ?? 'auth/login';

$router->dispatch($route);
