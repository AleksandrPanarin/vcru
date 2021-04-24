<?php


namespace App\System;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as Manager;

class EntityManager
{
    /**
     * @return Manager
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     */
    public static function init(): Manager
    {
        $proxyDir = __DIR__ . "/../Proxies";
        $cache = new \Doctrine\Common\Cache\ArrayCache;

        $config = Setup::createAnnotationMetadataConfiguration(array(ROOT_DIR . "/Entities"),
            false, $proxyDir, $cache, false);
        $config->setAutoGenerateProxyClasses(true);

        $dbConfigFile = ROOT_DIR . '/config/config_db.php';
        if (!file_exists($dbConfigFile)) {
            throw new \Exception('Config file not found. Path: '. $dbConfigFile);
        }
        $connection = include_once $dbConfigFile;

        return Manager::create($connection, $config);
    }
}