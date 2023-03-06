<?php

namespace services\interfaces\image_compression;
interface ImageCompressionInterface
{
    public function compress(array $file, string $email): string;
}