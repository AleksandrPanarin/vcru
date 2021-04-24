<?php

use App\Controllers\ApiController;

require '../vendor/autoload.php';


return FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/advertisement', function (){
        header("Location: /advertisement/1");
        exit();
    });
    $r->addRoute('GET', '/advertisement/{page:\d+}', [ApiController::class , 'getAdvertisement']);
    $r->addRoute('POST', '/advertisement', [ApiController::class , 'create']);
    $r->addRoute('PATCH', '/advertisement', [ApiController::class , 'update']);
});