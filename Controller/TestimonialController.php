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
        return $testimonial->getAll(['where'=>['product_id', '=', $this->productId], 'limit'=>5, 'orderby'=>['created_at', 'desc']]);
    }

    // Добавление отзыва
    public function store()
    {
        // Валидируем параметры из реквеста
        $request = new Request();
        $validate = $request->validate([
            'product_id'  => 'required|numeric',
            'name'        => 'required|alpha_spaces',
            'email'       => 'required|email',
            'message'     => 'required',
        ]);
        if (!$validate) return json_encode($request->validate_errors());

        // Добавляем отзыв в бд
        $testimonial = new Testimonial();
        $newTestimonial = $testimonial->create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);
        if (!$newTestimonial) return json_encode($testimonial->get_errors());

        // Получаем представление нового отзыва и отправляем его в формате json
        $html = view('Testimonial', compact('newTestimonial'));
        return json_encode(['status'=>'success', 'html'=>$html]);
    }
}
