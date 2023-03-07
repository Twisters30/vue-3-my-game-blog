<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

define('ROOT', dirname(__DIR__) . '/');
const DEBUG = true;
const TINIFY_API_KEY = '6YKpwQZ9mzCfgQk4zq1KRfsHgSXxtMPW';
const SECRET_KEY = '$2y$10$a8LPnDBBaIDFI..UuzPRZe0QlizH3L8uqyTI2tzRjib8pju0ymjTS';
const JWT_ALGORITHM = 'HS256';
const TOKEN_LIFETIME = '+15 minutes';
const DOMAIN = 'myblog.com';
