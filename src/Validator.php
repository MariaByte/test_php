<?php

class Validator
{
    public $request = [];
    public function __construct(array $data) {
        $this->request = $data;
    }

    public function validate() {
        $errors = [];

        if (empty($this->request['name']) || !preg_match("/^\s*([a-zA-Za-яА-ЯёЁ]{2,20}+\s*)$/u", $this->request['name'])) {
            $errors[] = 'Имя должно состоять из букв и быть длиной от 2 до 20 символов';
        }

        if (empty($this->request['email'])) {
            $errors[] = 'Email не может быть пустым';
        } elseif (!filter_var($this->request['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Неверный формат email';
        }

        if (empty($this->request['password'])) {
            $errors[] = 'Пораль не может быть пустым';
        } elseif (strlen($this->request['password']) < 3) {
            $errors[] = 'Пароль должен быть не менее 3 символов';
        }

        return $errors;
    }
}
