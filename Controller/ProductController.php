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

    public function show()
    {
        $product = new Product();
        if ($product->get($this->vars['id'])) {
            $title = $product->name;
            return view('product', compact('product', 'title'));
        }
        return 'Товар не найден';
    }
}
