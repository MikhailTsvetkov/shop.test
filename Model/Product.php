<?php

namespace Model;

class Product extends Model
{
    public int $id;
    public string $name;
    public string $description;
    public int $price;
    public string $image;
    public string $created_at;
    public string $updated_at;

    // Получение товара
    public function get(int $id)
    {
        $this->query("SELECT * FROM {$this->table} WHERE id=?", $id);
        return $this->fetchOne();
    }
}
