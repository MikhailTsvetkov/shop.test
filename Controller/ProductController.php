<?php

namespace Controller;

use Model\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = new Product();
        $product->query("SELECT * FROM products LIMIT 5");
        $rows = $product->getAllRows();
        return view('index', ['products' => $rows]);
    }

    public function show()
    {
        $product = new Product();
        $product->query("SELECT * FROM products WHERE id=?", $this->vars['id']);
        $product->fetchOne();
        return view('index', ['products' => $product]);
    }
}
