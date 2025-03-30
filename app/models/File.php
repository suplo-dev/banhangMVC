<?php

class File extends Model
{

    private string $table = 'files';

    public function addProductFile($productId, $fileUrl)
    {
        $stmt = $this->db->prepare("INSERT INTO $this->table (product_id, file_url) VALUES (?, ?)");
        return $stmt->execute([$productId, $fileUrl]);
    }

    public function getProductFiles($product_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE product_id = ?");
        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteProductFile($productId): bool
    {
        $stmt = $this->db->prepare("UPDATE $this->table SET deleted_at = NOW() WHERE product_id = ?");
        return $stmt->execute([$productId]);
    }
}
