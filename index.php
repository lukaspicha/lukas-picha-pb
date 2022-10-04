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

    $parseTxt = new Helpers\ParseTxt();
    $parseTxt->importFile(DOCROOT . DS . "data.txt");
    $data = $parseTxt->getData();

    $startDate =  new DateTime();
    $group = Models\Group::getInstance($data);

    $stats = new Helpers\Stats($group);
    $sex = "F";
    $relativeFreqPercent = $stats->getRelativeFrequency('sex', $sex) * 100;


    echo "Lide s txt + délka jejich života:<br>";
    foreach ($group as $key => $person) {
        echo $person . ", délka života v dnech: " . $person->getLengthOfLife($startDate) ."<br>";
    }

    echo "<br>";

    echo "Nalezec dle id: " . $group->findById("1900307216");

    echo "<br>";
    echo "Procentuální zastoupení pohlaví {sex}: {$relativeFreqPercent} %";


}catch (Exception $e){
    var_dump('ERROR');
    var_dump($e->getCode());
    var_dump($e->getMessage());
    var_dump($e);
}