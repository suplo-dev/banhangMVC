<?php

class Product extends Model
{

    private string $table = 'products';

    public function getAllProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE deleted_at IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        if (is_array($id)) {
            if (count($id) <= 0) {
                $id = [0];
            }
            $placeholders = implode(',', array_fill(0, count($id), '?'));
            $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE id IN ($placeholders)");
            $stmt->execute($id);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE id = ? AND deleted_at IS NULL");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }


    public function getProductBySlug($slug)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE slug = :slug AND deleted_at IS NULL");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $thumbPath, $price, $description, $category_id): int
    {
        $stmt = $this->db->prepare("INSERT INTO $this->table (name, thumb_url, price, description, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $thumbPath, $price, $description, $category_id]);
        return $this->db->lastInsertId();
    }

    public function updateProduct($id, $name, $thumbPath, $price, $description, $category_id)
    {
        $stmt = $this->db->prepare("UPDATE $this->table SET name = ?, thumb_url = ?, price = ?, description = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$name, $thumbPath, $price, $description, $category_id, $id]);
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare("UPDATE $this->table SET deleted_at = NOW() WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function filterProducts($categoryId = 0, $minPrice = 0, $maxPrice = 0)
    {
        $sql = "SELECT * FROM $this->table WHERE 1=1";
        $params = [];

        if ($categoryId > 0) {
            $sql .= " AND category_id = ?";
            $params[] = $categoryId;
        }
        if ($minPrice > 0) {
            $sql .= " AND price >= ?";
            $params[] = $minPrice;
        }
        if ($maxPrice > 0) {
            $sql .= " AND price <= ?";
            $params[] = $maxPrice;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProductsByName(string $keyword, int $offset = 0, int $limit = 20)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE name LIKE ? AND deleted_at IS NULL LIMIT $limit OFFSET $offset");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalProductsByName(string $keyword)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM $this->table WHERE name LIKE ? AND deleted_at IS NULL");
        $stmt->execute(["%$keyword%"]);
        return $stmt->fetchColumn();
    }

    public function getListProductHomePage()
    {
        $stmt = $this->db->prepare("
            SELECT * FROM $this->table
            LEFT JOIN categories ON $this->table.category_id = categories.id
            WHERE show_home = 1
        ");
    }

    public function getProductsByCategoryId(int $categoryId, int $limit = 0): array
    {
        $query = "SELECT * FROM $this->table WHERE category_id = ? AND deleted_at IS NULL";
        if ($limit > 0) {
            $query .= " LIMIT " . intval($limit);
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchProduct(array $params, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT * FROM $this->table";
        $arrWhere = ['deleted_at IS NULL'];
        $bindings = [];
        if (!empty($params['keyword'])) {
            $arrWhere[] = "name LIKE :keyword";
            $bindings[':keyword'] = '%' . $params['keyword'] . '%';
        }
        if ($params['category_id'] > 0) {
            $arrWhere[] = "category_id = :category_id";
            $bindings[':category_id'] = (int) $params['category_id'];
        }
        if ($params['min_price'] > 0) {
            $arrWhere[] = "price >= :min_price";
            $bindings[':min_price'] = (int) $params['min_price'];
        }
        if ($params['max_price'] > 0) {
            $arrWhere[] = "price <= :max_price";
            $bindings[':max_price'] =(int) $params['max_price'];
        }
        if (count($arrWhere) > 0) {
            $query .= " WHERE " . implode(" AND ", $arrWhere);
        }
        $query .= " LIMIT $limit OFFSET $offset";
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProduct(array $params, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT COUNT(*) FROM $this->table";
        $arrWhere = ["deleted_at IS NULL"];
        $bindings = [];
        if (!empty($params['keyword'])) {
            $arrWhere[] = "name LIKE :keyword";
            $bindings[':keyword'] = '%' . $params['keyword'] . '%';
        }
        if ($params['category_id'] > 0) {
            $arrWhere[] = "category_id = :category_id";
            $bindings[':category_id'] = (int) $params['category_id'];
        }
        if ($params['min_price'] > 0) {
            $arrWhere[] = "price >= :min_price";
            $bindings[':min_price'] = (int) $params['min_price'];
        }
        if ($params['max_price'] > 0) {
            $arrWhere[] = "price <= :max_price";
            $bindings[':max_price'] =(int) $params['max_price'];
        }
        if (count($arrWhere) > 0) {
            $query .= " WHERE " . implode(" AND ", $arrWhere);
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchColumn();
    }

    public function countAll() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM products");
        return $stmt->fetchColumn();
    }

}
