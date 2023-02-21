<?php
namespace validation\interfaces;

interface ValidatorInterface
{
    public function validate(array $data, array $rules): void;

    public function getErrors(): array;

}