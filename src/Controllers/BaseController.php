<?php

namespace App\Controllers;

use App\System\EntityManager;

/**
 * Class BaseController
 * @package App\Controllers
 */
abstract class BaseController
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * ApiController constructor.
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public function __construct()
    {
        $this->em = EntityManager::init();
    }

}