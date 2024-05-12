<?php

namespace Laravel\Blog\Framework\Validators;

interface Validator
{
    public function validateField(string $fieldName, $value): bool;
    public function getErrors(): array;
}