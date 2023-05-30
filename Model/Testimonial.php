<?php

namespace Model;

class Testimonial extends Model
{
    public int $id;
    public int $product_id;
    public string $name;
    public string $email;
    public string $message;
    public string $created_at;
    public string $updated_at;

    public array $fillable = [
       'product_id',
       'name',
       'email',
       'message',
    ];
}
