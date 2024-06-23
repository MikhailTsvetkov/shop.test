<?php

/**
 * @param string $view
 * @param array $vars
 *
 * @return string
 */
function view(string $view, array $vars = []): string
{
    $content = new Core\View($view, $vars);
    return $content->get();
}
