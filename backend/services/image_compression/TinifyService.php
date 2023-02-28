<?php

namespace services\image_compression;

use services\interfaces\image_compression\ImageCompressionInterface;

class TinifyService implements ImageCompressionInterface
{

    public function __construct()
    {
        self::setKey();
    }
    public function compress($file)
    {
        $source = \Tinify\fromFile($file);
        return $source->toFile(ROOT.'public/images/compressed_image.jpg');
    }

    private static function setKey(): void
    {
        \Tinify\setKey(TINIFY_API_KEY);
    }
}