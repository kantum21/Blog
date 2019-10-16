<?php
// Define constants for dev environment
require '../config/dev.php';
// SetUp autoload by composer
require '../vendor/autoload.php';
// Launch session
session_start();
// Create Router
$router = new \App\config\Router();
// Execute it
$router->run();