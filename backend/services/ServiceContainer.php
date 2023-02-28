<?php

namespace services;

class ServiceContainer
{
    private static array $services = [];

    public static function register($interface, $resolver): void
    {
        self::$services[$interface] = $resolver;
    }

    public static function getService($interface): object
    {
        if (!isset(self::$services[$interface])) {
            throw new \Exception("Сервис {$interface} не найден", 500);
        }

        $resolver = self::$services[$interface];

        if (is_callable($resolver)) {
            self::$services[$interface] = $resolver();
        }

        return self::$services[$interface];
    }
}