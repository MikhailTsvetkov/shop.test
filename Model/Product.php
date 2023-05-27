<?php

namespace Model;

class Product extends Model
{
    public int $id;
    public string $name;
    public string $description;
    public int $price;
    public string $created_at;
    public string $updated_at;

    public function fieldsTable(): array
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'description' => 'description',
            'price' => 'price',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
        ];
    }
}
