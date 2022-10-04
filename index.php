<?php


error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('DOCROOT', __DIR__);
define('APP_DIR', DOCROOT . DS . 'app');
define('TEMP_DIR', DOCROOT . DS . 'temp');

require_once DOCROOT . DS . 'vendor' . DS . 'autoload.php';

try {

    session_start();

    $robotLoader = new \Nette\Loaders\RobotLoader();
    $robotLoader->addDirectory(APP_DIR);
    $robotLoader->setTempDirectory(TEMP_DIR . DS . 'robotloader');
    $robotLoader->setAutoRefresh(true);
    $robotLoader->register();

    $person = new Models\Person(1, "L", "P", "m", new DateTime("1990-01-01"));
    echo $person->getLengthOfLife(new DateTime());

}catch (Exception $e){
    var_dump('ERROR');
    var_dump($e->getCode());
    var_dump($e->getMessage());
    var_dump($e);
}