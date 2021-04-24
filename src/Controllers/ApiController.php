<?php

namespace App\Controllers;


use App\System\EntityManager;
use App\System\JsonResponse;
use App\System\Request;

class ApiController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct()
    {
        $this->em = EntityManager::init();
    }

    public function getAdvertisement(int $page): JsonResponse
    {
        return new JsonResponse([
            'page' => $page
        ], JsonResponse::HTTP_OK);
    }

    public function create(Request $request): JsonResponse
    {
        return new JsonResponse([
            'page' => '1'
        ], JsonResponse::HTTP_OK);
    }

    public function update(Request $request): JsonResponse
    {
        return new JsonResponse([
            'page' => 1
        ], JsonResponse::HTTP_OK);
    }
}