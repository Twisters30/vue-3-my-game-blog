<?php


namespace validation;


use validation\interfaces\ValidatorInterface;

class Validator implements ValidatorInterface
{
    private array $errors = [];
    public function validate(array $data, array $rules): void
    {
        foreach ($rules as $field => $rule) {
            $names = $this->parseRule($rule);
            foreach ($names as $name) {
                $method = explode(':', $name);
                $methodName = 'validate' . ucfirst($method[0]);
                $params = $method[1] ?? '';
                if (method_exists($this, $methodName)) {
                    $this->$methodName($data[$field], $params);
                }
            }
        }
    }
    public function getErrors(): array
    {
        // TODO: Implement getErrors() method.
    }
    public function addError(string $field, string $message)
    {
        $this->errors[$field] = $message;
    }
    private function parseRule(string $rule)
    {
        return $rule ? explode('|', $rule) : [];
    }
    private function validateEmail(string  $email)
    {

    }
}