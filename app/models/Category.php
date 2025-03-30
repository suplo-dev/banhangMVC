<?php
class Category extends Model {

    private string $table = 'categories';

    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục
    public function addCategory($name, $showHome) {
        $stmt = $this->db->prepare("INSERT INTO $this->table (name, show_home) VALUES (?, ?)");
        $stmt->execute([$name, $showHome]);
    }

    public function updateCategory($id, $name, $showHome) {
        $stmt = $this->db->prepare("UPDATE $this->table SET name = ?, show_home = ? WHERE id = ?");
        $stmt->execute([$name, $showHome, $id]);
    }

    // Xóa danh mục
    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM $this->table WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getListCategoryShowHome (): array
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE show_home = 1");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchCategory(array $params, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT * FROM $this->table";
        $arrWhere = [];
        $bindings = [];
        if (!empty($params['keyword'])) {
            $arrWhere[] = "name LIKE :keyword";
            $bindings[':keyword'] = '%' . $params['keyword'] . '%';
        }
        if ($params['show_home'] > 0) {
            $arrWhere[] = "show_home = :show_home";
            $bindings[':show_home'] = (int) $params['show_home'];
        }
        if (!empty($arrWhere)) {
            $query .= ' WHERE ' . implode(' AND ', $arrWhere);
        }
        $query .= " LIMIT $limit OFFSET $offset";
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCategory(array $params, int $limit = 20, int $offset = 0)
    {
        $query = "SELECT COUNT(*) FROM $this->table";
        $arrWhere = [];
        $bindings = [];
        if (!empty($params['keyword'])) {
            $arrWhere[] = "name LIKE :keyword";
            $bindings[':keyword'] = '%' . $params['keyword'] . '%';
        }
        if ($params['show_home'] > 0) {
            $arrWhere[] = "show_home = :show_home";
            $bindings[':show_home'] = (int) $params['show_home'];
        }
        if (!empty($arrWhere)) {
            $query .= ' WHERE ' . implode(' AND ', $arrWhere);
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($bindings);
        return $stmt->fetchColumn();
    }
}
