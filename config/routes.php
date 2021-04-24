<?php

use App\Controllers\ApiController;

require_once '../init.php';

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addGroup('/v1', function () use ($r) {
        $r->addRoute('GET', '/advertisement/{page:\d+}', ['class' => ApiController::class, 'method' => 'getAdvertisement']);
        $r->addRoute('POST', '/advertisement', ['class' => ApiController::class, 'method' => 'create']);
        $r->addRoute('POST', '/advertisement/{advertisementId:\d+}', ['class' => ApiController::class, 'method' => 'update']);
    });
});