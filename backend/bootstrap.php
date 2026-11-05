<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/classes/Database.php';
require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Application.php';