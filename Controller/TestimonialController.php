<?php

namespace Controller;

use Core\Request;
use Model\Testimonial;

class TestimonialController extends Controller
{
    private int $productId;

    public function set_productId(int $id): void
    {
        $this->productId = $id;
    }

    // Получение списка отзывов
    public function index()
    {
        $testimonial = new Testimonial();
        return $testimonial->getAll($this->productId, ['limit'=>5, 'orderby'=>['created_at', 'desc']]);
    }

    // Добавление отзыва
    public function store()
    {
        $request = new Request();
        $request->validate([
            'product_id'  => 'required|numeric',
            'name'        => 'required|alpha_spaces',
            'email'       => 'required|email',
            'message'     => 'required',
        ]);

        $testimonial = new Testimonial();
        $newTestimonial = $testimonial->create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        echo json_encode($newTestimonial);
    }
}