<?php

use services\ServiceContainer;
use validation\interfaces\ValidatorInterface;
use validation\Validator;
use services\interfaces\image_compression\ImageCompressionInterface;
use services\image_compression\TinifyService;


ServiceContainer::register(ImageCompressionInterface::class, function() {
    return new TinifyService();
});
ServiceContainer::register(ValidatorInterface::class, function() {
    return new Validator();
});
