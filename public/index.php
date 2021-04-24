<?php

use App\Kernel;
use App\System\JsonResponse;

require_once '../init.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $router = new Kernel();
    $router->run();
} catch (\Exception $e) {
    echo new JsonResponse([
        'message' => $e->getMessage()
    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
}