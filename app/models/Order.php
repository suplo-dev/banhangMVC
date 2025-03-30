<?php

class Order extends Model
{

    private $table = 'orders';

    public function searchOrder($keyword, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT orders.*, users.username, users.phone FROM orders 
            LEFT JOIN users ON orders.user_id = users.id";
        $bindings = [];
        if ($keyword) {
            $query .= " WHERE orders.id LIKE :keyword OR orders.phone LIKE :keyword OR user.phone LIKE :keyword";
            $bindings[':keyword'] = '%' . $keyword . '%';
        }
        $query .= " LIMIT $limit OFFSET $offset";
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countOrder($keyword)
    {
        $query = "SELECT COUNT(*) FROM orders 
            LEFT JOIN users ON orders.user_id = users.id";
        $bindings = [];
        if ($keyword) {
            $query .= " WHERE orders.id LIKE :keyword OR orders.phone LIKE :keyword OR user.phone LIKE :keyword";
            $bindings[':keyword'] = '%' . $keyword . '%';
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchColumn();
    }

    public function createOrder($name, $phone, $address, $total, $items)
    {
        $stmt = $this->db->prepare("INSERT INTO orders (customer_name, phone, address, total_amount, user_id, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$name, $phone, $address, $total, $_SESSION['user']['id'] ?? 0]);
        $orderId = $this->db->lastInsertId();
        foreach ($items as $item) {
            $stmt = $this->db->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->execute([$orderId, $item['product_id'], $item['quantity']]);
        }
        return $orderId;
    }

    public function getOrdersByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = :user_id ORDER BY id DESC");
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderById($orderId)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = :id");
        $stmt->execute([':id' => $orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($orderId)
    {
        $stmt = $this->db->prepare("SELECT * FROM order_items LEFT JOIN products ON order_items.product_id = products.id  WHERE order_id = :order_id");
        $stmt->execute([':order_id' => $orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateOrder(array $params)
    {
        $stmt = $this->db->prepare("UPDATE $this->table SET customer_name = :customer_name, phone = :phone, address = :address, status = :status WHERE id = :id");
        return $stmt->execute([':customer_name' => $params['customer_name'], ':phone' => $params['phone'], ':address' => $params['address'], ':status' => $params['status'], ':id' => $params['id']]);
    }

    // Đếm tất cả đơn hàng
    public function countAll()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM orders");
        return $stmt->fetchColumn();
    }

    // Đếm số đơn hàng theo trạng thái
    public function countByStatus($status)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM orders WHERE status = :status");
        $stmt->execute([':status' => $status]);
        return $stmt->fetchColumn();
    }

    // Tính tổng doanh thu từ đơn hàng đã hoàn tất
    public function getTotalRevenue()
    {
        $stmt = $this->db->query("SELECT SUM(total_amount) FROM orders WHERE status = 'Hoàn thành'");
        return $stmt->fetchColumn() ?? 0;
    }
}
