<?php

use Core\View;

function view(string $view, array $vars=[]): string
{
    $content = new View($view, $vars);
    return $content->get();
}
