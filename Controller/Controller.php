<?php

namespace Controller;

abstract class Controller
{
    protected array $vars = [];
    public function set_vars(array $vars): void
    {
        $this->vars = $vars;
    }
    abstract function index();
}
