<?php
namespace controllers;

trait SingletonTrait
{

    private static ?self $instance = null;

    private function __construct(){}

    public static function getInstance()
    {
        return static::$instance ?? static::$instance = new static();
    }

}