<?php

namespace services\image_compression;

use services\interfaces\image_compression\ImageCompressionInterface;

class TinifyService implements ImageCompressionInterface
{

    public function __construct()
    {
        self::setKey();
    }
    public function compress(array $file, string $email): string
    {
        $source = \Tinify\fromFile($file['tmp_name']);
        $path = "public/images/{$email}";

        if (!file_exists(ROOT . $path)) {
            mkdir(ROOT . $path, 0777, true);
        }

        $source->toFile(ROOT . "{$path}/{$file['name']}");

        return "{$path}/{$file['name']}";
    }

    private static function setKey(): void
    {
        \Tinify\setKey(TINIFY_API_KEY);
    }
}