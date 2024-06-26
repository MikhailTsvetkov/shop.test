<?php

namespace Core;

class View
{
    public string $view;
    public array $vars;

    public function __construct(string $view, array $vars=[])
    {
        $this->view = 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . trim(str_replace('.', DIRECTORY_SEPARATOR, $view)) . '.php';
        $this->vars = $vars;

        // Проверка существования файла, иначе 404
        if (!is_readable($this->view)) {
            die ('404 Not Found');
        }
    }

    public function get(): string
    {
        // Устанавливаем массив переменных для слоев
        $_VARS = $this->vars;

        // Импорт переменных в текущую таблицу символов
        extract($this->vars);

        // Буферизация вывода
        ob_start();
            include $this->view;
            $content = ob_get_contents() ?? '';
        ob_end_clean();

        return $content;
    }
}