<?php

namespace App\Controllers;

use App\Entities\Advertisement;
use App\Requests\AdvertisementRequest;
use App\System\JsonResponse;
use App\System\Request;
use App\Utils\FileUploader;

/**
 * Class ApiController
 * @package App\Controllers
 */
class ApiController extends BaseController
{
    /**
     * @param int $page
     * @return JsonResponse
     */
    public function getAdvertisement(int $page): JsonResponse
    {
        return new JsonResponse([
            'page' => $page
        ], JsonResponse::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $requestData = $request->getData();
        $requestValidate = new AdvertisementRequest($requestData);
        if (!$requestValidate->isValid()) {
            return new JsonResponse($requestValidate->getErrors(), JsonResponse::HTTP_BAD_REQUEST);
        }
        $advertisement = $this->process($requestData);

        return new JsonResponse(['advertisement' => $advertisement->toArray()], JsonResponse::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param int $advertisementId
     * @return JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function update(int $advertisementId, Request $request): JsonResponse
    {
        $requestData = $request->getData();
        $requestValidate = new AdvertisementRequest($requestData);
        if (!$requestValidate->isValid()) {
            return new JsonResponse($requestValidate->getErrors(), JsonResponse::HTTP_BAD_REQUEST);
        }
        $advertisement = $this->process($requestData, $advertisementId);
        return new JsonResponse(['advertisement' => $advertisement->toArray()], 200);
    }

    /**
     * @param array $data
     * @param int $advertisementId
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    private function process(array $data, int $advertisementId = 0): Advertisement
    {
        $advertisement = new Advertisement();
        if ($advertisementId) {
            /** @var Advertisement $advertisement */
            $advertisement = $this->em->getRepository(Advertisement::class)->find($advertisementId);
            if (!$advertisement) {
                throw new \Exception(
                    "Advertisement by ID {$advertisementId}  not found",
                    JsonResponse::HTTP_BAD_REQUEST
                );
            }
            if ($advertisement->getBanner()) {
                FileUploader::remove($advertisement->getBanner());
            }
        }
        $bannerPath = FileUploader::upload($data['banner']);
        $advertisement
            ->setText($data['text'])
            ->setAmount($data['amount'])
            ->setPrice($data['price'])
            ->setBanner($bannerPath);

        $this->em->persist($advertisement);
        $this->em->flush();

        return $advertisement;
    }
}