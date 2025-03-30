<?php
class News extends Model {
    public function getAllNews() {
        $stmt = $this->db->prepare("SELECT * FROM news ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNewsById($id) {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addNews($title, $content, $image) {
        $stmt = $this->db->prepare("INSERT INTO news (title, content, image) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $content, $image]);
    }

    public function updateNews($id, $title, $content, $image) {
        $stmt = $this->db->prepare("UPDATE news SET title = ?, content = ?, image = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $image, $id]);
    }

    public function deleteNews($id) {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
