<?php

namespace App\Repositories;

use App\Entities\Advertisement;
use Doctrine\ORM\EntityRepository;

class AdvertisementRepository extends EntityRepository
{
    /**
     * @param int $id
     * @return Advertisement|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByIdAndNotMoreLimit(int $id): ?Advertisement
    {
       return $this->createQueryBuilder('a')
            ->where('a.id = :id')
            ->andWhere('a.amount > a.amountShow')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}