<?php
class User {
    public static function findByLogin($login) {
        $stmt = Database::pdo()->prepare("
            SELECT u.*, r.name as role_name 
            FROM users u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.login = ?
        ");
        $stmt->execute([$login]);
        return $stmt->fetch();
    }
    public static function create($data) {
        $stmt = Database::pdo()->prepare("INSERT INTO users (role_id, login, password_hash, full_name, phone, email) VALUES (1, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['login'], password_hash($data['password'], PASSWORD_DEFAULT),
            $data['full_name'], $data['phone'], $data['email']
        ]);
    }
}