<?php

namespace routes;

class RouteAttributeService
{
    protected static array $availableAttributes = [
        'prefix',
        'role',
        'namespace'
    ];

    public static function checkAttributes(array $attributes): void
    {
        foreach ($attributes as $name => $value) {
            if (!in_array(strtolower($name) , self::$availableAttributes)) {
                throw new \Exception("недопустимый атрибут марштура '{$name}'", 500);
            }
        }
    }

    public static function prefix(array $attributes): string
    {
        $prefix = '';
        if (isset($attributes['prefix'])) {
            $prefix = $attributes['prefix'];
        }
        return $prefix;
    }

    public static function namespace(array $attributes): string
    {
        $namespace = '';
        if (isset($attributes['namespace'])) {
            $namespace = $attributes['namespace'] . '\\';
            unset($attributes['namespace']);
        }
        return $namespace;
    }
}