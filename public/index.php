<?php
// Show PHP errors (useful during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load DB + Controller
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../app/controllers/MainController.php';

// Connect database
$db = (new Database())->connect();

// Create controller
$controller = new MainController($db);

// Execute the single-page logic
$controller->handle();
