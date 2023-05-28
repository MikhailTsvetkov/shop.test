<?php

namespace Core;

use Rakit\Validation\Validator;

class Request
{
    public array $requestData;
    public function __construct()
    {
        $this->all();
    }

    // Получение объекта со свойствами $_GET
    public function get(): Request
    {
        $this->_setProperties($_GET);
        return $this;
    }

    // Получение объекта со свойствами $_POST
    public function post(): Request
    {
        $this->_setProperties($_POST);
        return $this;
    }

    // Получение объекта со свойствами $_REQUEST
    public function all(): Request
    {
        $this->_setProperties($_REQUEST);
        return $this;
    }

    public function validate(array $rules)
    {
        $validator = new Validator;
        $validation = $validator->make($this->requestData, $rules);
        $validation->validate();
        if ($validation->fails()) {
            // handling errors
            $errors = $validation->errors();
            $this->validate_errors = array_merge(['status'=>'error'], ['errors'=>$errors->firstOfAll()]);
            return false;
        }
        return true;
    }


    public function validate_errors() {
        return $this->validate_errors;
    }

    // Очистка свойств объекта перед повторным вызовом
    private function _clearProperties()
    {
        $props = get_class_vars(__CLASS__);
        foreach ($props as $k=>$v) {
            unset($this->{$k});
        }
    }

    // Установка свойств в зависимости от метода
    private function _setProperties(array $method): void
    {
        $this->_clearProperties();
        foreach ($method as $k=>$v) {
            $this->{$k} = nl2br(strip_tags($v));
        }
        $this->requestData = $method;
    }
}
