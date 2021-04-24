<?php
define('ROOT_DIR', __DIR__);
define('PATH_TO_PUBLIC', __DIR__.'/public');
define('REQUEST_SCHEME_HOST', $_SERVER['REQUEST_SCHEME'] .'://'.$_SERVER['HTTP_HOST']);
require_once 'vendor/autoload.php';
