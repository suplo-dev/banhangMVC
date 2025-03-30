<?php
class PasswordReset extends Model {

    private $table = "password_reset";
    public function saveResetToken($userId, $token, $expiresAt)
    {
        $stmt = $this->db->prepare("INSERT INTO $this->table (user_id, token, expires_at) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $token, $expiresAt]);
    }

    public function getResetToken($token)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteResetToken($token)
    {
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE token = ?");
        $stmt->execute([$token]);
    }
}
