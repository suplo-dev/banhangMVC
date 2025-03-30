<?php
class Banner extends Model {
    public function getAllBanners() {
        $stmt = $this->db->prepare("SELECT * FROM banners");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBannerById($id) {
        $stmt = $this->db->prepare("SELECT * FROM banners WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBanner($title, $image, $link) {
        $stmt = $this->db->prepare("INSERT INTO banners (title, image, link) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $image, $link]);
    }

    public function updateBanner($id, $title, $image, $link) {
        $stmt = $this->db->prepare("UPDATE banners SET title = ?, image = ?, link = ? WHERE id = ?");
        return $stmt->execute([$title, $image, $link, $id]);
    }

    public function deleteBanner($id) {
        $stmt = $this->db->prepare("DELETE FROM banners WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
