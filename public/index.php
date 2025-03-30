<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require_once '../core/Router.php';
require_once '../core/Controller.php';
require_once '../core/Model.php';

$url = isset($_GET['url']) ? $_GET['url'] : '';
$router = new Router();
$router->route($url);

