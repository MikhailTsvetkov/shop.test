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
        $this->query("SELECT * FROM products WHERE id=?", $id);
        return $this->fetchOne();
    }

    // Получение всех товаров
    public function getAll(array $options=[])
    {
        $query_parameters = $this->getQueryOptions($options);
        $this->query("SELECT * FROM products $query_parameters");
        return $this->getAllRows();
    }
}
