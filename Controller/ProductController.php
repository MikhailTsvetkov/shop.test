<?php

namespace Controller;

use Model\Product;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Магазин';
        $product = new Product();
        $products = $product->getAll(['limit'=>5]);
        return view('index', compact('products', 'title'));
    }

    public function show(int $id): string
    {
        $product = new Product();
        if ($product->get($id)) {
            $title = $product->name;

            $testimonial = new TestimonialController();
            $testimonial->set_productId($id);
            $testimonials = $testimonial->index();
            return view('product', compact('product', 'testimonials', 'title'));
        }
        return 'Товар не найден';
    }

    function store()
    {
        // TODO: Implement store() method.
    }
}
