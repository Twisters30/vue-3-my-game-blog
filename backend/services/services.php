<?php
use services\ServiceContainer;
use validation\interfaces\ValidatorInterface;
use validation\Validator;
use services\interfaces\image_compression\imageCompressionInterface;
use sevices\image_compression\TinifyService;

ServiceContainer::register(imageCompressionInterface::class, function() {
    return new TinifyService();
});
ServiceContainer::register(ValidatorInterface::class, function () {
    return new Validator();
});