<?php

namespace Laravel\Blog\Framework\Validators;

use Laravel\Blog\Framework\Validators\Validator;

class FormValidator implements Validator
{

    private $errors = [];
    private $minLength = 3;
    private $maxLength = 255;

    public function validateField(string $fieldName, $value): bool
    {
        $isValid = true;

        switch ($fieldName) {
            case 'name':
                if (empty(trim($value)) || strlen(trim($value)) < $this->minLength || strlen(trim($value)) > $this->maxLength) {
                    $this->errors[$fieldName] = 'Поле "Имя" должно быть от ' . $this->minLength . ' до ' . $this->maxLength . ' символов.';
                    $isValid = false;
                }
                break;
            case 'email':
                if (empty(trim($value)) || !filter_var($value, FILTER_VALIDATE_EMAIL) || strlen(trim($value)) > $this->maxLength) {
                    $this->errors[$fieldName] = 'Некорректный email или длина превышает ' . $this->maxLength . ' символов.';
                    $isValid = false;
                }
                break;
            case 'password':
                if (empty(trim($value)) || strlen(trim($value)) < $this->minLength || strlen(trim($value)) > $this->maxLength) {
                    $this->errors[$fieldName] = 'Поле "Пароль" должно быть от ' . $this->minLength . ' до ' . $this->maxLength . ' символов.';
                    $isValid = false;
                }
                break;
            case 'password_confirmation':
                if (empty(trim($value)) || strlen(trim($value)) < $this->minLength || strlen(trim($value)) > $this->maxLength) {
                    $this->errors[$fieldName] = 'Поле "Подтверждение пароля" должно быть от ' . $this->minLength . ' до ' . $this->maxLength . ' символов.';
                    $isValid = false;
                }
                break;
            case 'comment':
                if (empty(trim($value)) || strlen(trim($value)) > $this->maxLength) {
                    $this->errors[$fieldName] = 'Комментарий должен быть меньше 255 символов';
                    $isValid = false;
                }
                break;
        }


        return $isValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}