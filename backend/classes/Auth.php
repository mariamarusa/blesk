<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth {
    public static function check() { 
        return isset($_SESSION['user']); 
    }
    
    public static function isAdmin() { 
        return self::check() && (
            (isset($_SESSION['user']['role_name']) && $_SESSION['user']['role_name'] === 'admin') 
            || $_SESSION['user']['login'] === 'Admin'
        ); 
    }
    
    public static function requireUser() {
        if (!self::check()) { 
            header('Location: /frontend/login.php'); 
            exit; 
        }
    }
    
    public static function requireAdmin() {
        if (!self::isAdmin()) { 
            header('Location: /frontend/index.php'); 
            exit; 
        }
    }
}