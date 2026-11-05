<?php
class Application {
    
    
    public static function create($userId, $data) {
        $stmt = Database::pdo()->prepare("INSERT INTO applications (user_id, address, phone, desired_date, desired_time, service_id, payment_method_id, status_id) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
        return $stmt->execute([
            $userId, 
            $data['address'], 
            $data['phone'], 
            $data['desired_date'], 
            $data['desired_time'], 
            $data['service_id'], 
            $data['payment_method_id']
        ]);
    }
    
   
    public static function forUser($userId) {
        $stmt = Database::pdo()->prepare("
            SELECT a.*, s.name as service_name, st.name as status_name 
            FROM applications a 
            JOIN services s ON a.service_id = s.id 
            JOIN statuses st ON a.status_id = st.id 
            WHERE a.user_id = ? 
            ORDER BY a.id DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    
   
    public static function all($statusId = null) {
        $sql = "SELECT a.*, CONCAT(u.last_name, ' ', u.first_name, ' ', IFNULL(u.middle_name, '')) as user_name, 
                s.name as service_name, st.name as status_name 
                FROM applications a 
                JOIN users u ON a.user_id = u.id 
                JOIN services s ON a.service_id = s.id 
                JOIN statuses st ON a.status_id = st.id";
        
        if ($statusId) {
            $sql .= " WHERE a.status_id = ?";
        }
        
        $sql .= " ORDER BY a.id DESC";
        
        $stmt = Database::pdo()->prepare($sql);
        if ($statusId) {
            $stmt->execute([$statusId]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchAll();
    }
    
    public static function updateStatus($appId, $statusId, $cancelReason = null) {
        $stmt = Database::pdo()->prepare("UPDATE applications SET status_id = ?, cancel_reason = ? WHERE id = ?");
        return $stmt->execute([$statusId, $cancelReason, $appId]);
    }
}