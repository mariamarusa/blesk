<?php
class Review {
    public static function create($appId, $rating, $comment) {
        $stmt = Database::pdo()->prepare("INSERT INTO reviews (application_id, rating, comment) VALUES (?, ?, ?)");
        return $stmt->execute([$appId, $rating, $comment]);
    }

    public static function getByApplicationId($appId) {
        $stmt = Database::pdo()->prepare("SELECT * FROM reviews WHERE application_id = ?");
        $stmt->execute([$appId]);
        return $stmt->fetch();
    }
}