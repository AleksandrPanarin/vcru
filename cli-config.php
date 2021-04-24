<?php

use App\System\EntityManager;
use \Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once 'vendor/autoload.php';

$entityManager = EntityManager::init();

return ConsoleRunner::createHelperSet($entityManager);