<?php
class User extends Model {

    private $table = "users";
    public function register($username, $password, $email, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $email, $role]);
    }

    public function add($username, $password, $email, $role, $phone, $address) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email, role, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $email, $role,  $phone, $address]);
    }

    public function update($id, $username, $email, $role, $phone, $address) {
        $stmt = $this->db->prepare("UPDATE users SET username = :username, email = :email, role = :role, phone = :phone, address = :address WHERE id = :id");
        return $stmt->execute([':username' => $username, ':email' => $email, ':role' => $role, ':phone' => $phone, ':address' => $address, 'id' => $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function login($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT id, username, email, role FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM users WHERE role = 'customer'");
        return $stmt->fetchColumn();
    }

    public function searchUser(array $params, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT * FROM $this->table LEFT JOIN (SELECT COUNT(*) as total_orders, user_id FROM orders GROUP BY user_id) as t ON $this->table.id = t.user_id";
        $arrWhere = [];
        $bindings = [];
        if (!empty($params['keyword'])) {
            $arrWhere[] = "name LIKE :keyword";
            $bindings[':keyword'] = '%' . $params['keyword'] . '%';
        }
        if (!empty($params['role'])) {
            $arrWhere[] = "role = :role";
            $bindings[':role'] = $params['role'];
        }
        if (count($arrWhere) > 0) {
            $query .= " WHERE " . implode(" AND ", $arrWhere);
        }
        $query .= " LIMIT $limit OFFSET $offset";
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUser(array $params, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT COUNT(*) FROM $this->table";
        $arrWhere = [];
        $bindings = [];
        if (!empty($params['keyword'])) {
            $arrWhere[] = "name LIKE :keyword";
            $bindings[':keyword'] = '%' . $params['keyword'] . '%';
        }
        if (!empty($params['role'])) {
            $arrWhere[] = "role = :role";
            $bindings[':role'] = $params['role'];
        }
        if (count($arrWhere) > 0) {
            $query .= " WHERE " . implode(" AND ", $arrWhere);
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchColumn();
    }

    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($userId, $password)
    {
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$password, $userId]);
    }
}
