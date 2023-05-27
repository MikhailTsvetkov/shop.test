<?php

namespace Core;

class Route
{
    private static Route|null $instance = null;
    private string $controller;
    private string $action;
    private array $vars = [];


    private function __construct()
    {

    }



    private static function getInstance(string $controller, string $action): Route
    {
        // Создаем экземпляр класса, если его не существует, и устанавливаем свойства
        if (!self::$instance) {
            self::$instance = new self;
        }
        self::$instance->controller = trim($controller);
        self::$instance->action = trim($action);
        return self::$instance;
    }

    public static function get(string $uri, string $controller, string $action='index'): void
    {
        if ($_SERVER['REQUEST_METHOD']=='GET') {
            $route = self::getInstance($controller, $action);

            // Проверяем uri и если есть совпадение, отправляем данные на обработку контроллеру
            if (self::$instance->checkUri($uri)) {
                $route->start();
            }
        }
    }

    private function checkUri(string $route_uri): bool
    {
        // Получаем $request_uri из $_SERVER['REQUEST_URI'], отбрасывая GET-параметры
        $request_uri = strtok($_SERVER['REQUEST_URI'], '?');

        // Удаляем оборачивающие слэши из $route_uri и $request_uri и приводим к нижнему регистру
        $route_uri = strtolower(trim($route_uri, '/'));
        $request_uri = strtolower(trim($request_uri, '/'));

        // Получаем переменные, если они есть
        $vars = array();
        preg_match_all('/\$([a-zA-Z0-9_]+)/', $route_uri, $vars);
        $var_names = $vars[1];

        // Заменяем переменные на регулярные выражения, если они есть
        $route_uri_regex = preg_replace_callback('/\$([a-zA-Z0-9_]+)/', function($matches) {
            return '([a-zA-Z0-9_-]+)';
        }, $route_uri);

        if (preg_match('#^' . $route_uri_regex . '$#', $request_uri, $matches)) {
            // Извлекаем значения переменных
            $var_values = array_slice($matches, 1);

            // Сохраняем переменные, если они есть, в массиве $this->vars
            if (!empty($var_names)) {
                foreach ($var_names as $index => $var_name) {
                    $this->vars[$var_name] = $var_values[$index];
                }
            }

            return true;
        }
        return false;
    }

    private function start(): void
    {
        // Создаём экземпляр контроллера
        $class = $this->controller;
        $controller = new $class();
        $controller->set_vars($this->vars);

        // Если экшен не существует - 404
        if (!is_callable(array($controller, $this->action))) {
            die ('404 Not Found');
        }

        // Выполняем экшен
        die ($controller->{$this->action}());
    }
}
