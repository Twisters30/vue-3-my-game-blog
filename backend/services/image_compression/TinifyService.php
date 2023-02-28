<?php


namespace sevices\image_compression;


use services\interfaces\image_compression\imageCompressionInterface;

class TinifyService implements imageCompressionInterface
{
    public function __construct()
    {
        self::setKey();
    }

    public function compress($file)
    {
        $sourceData = file_get_contents("unoptimized.jpg");
        $resultData = \Tinify\fromBuffer($sourceData)->toBuffer();
    }

    private static function setKey(): void
    {
        \Tinify\setKey(TINIFY_API_KEY);
    }
}