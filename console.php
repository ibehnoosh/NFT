<?php

use App\Application\CSVCommand;
use App\Application\Validators\ActionValidator;
use App\Application\Validators\FileValidator;
use App\Infrastructure\Logging\FileLogger;

require __DIR__.'/vendor/autoload.php';

define('FILES', __DIR__ . '/Files/');




$logFile = new FileLogger(FILES.'log.csv');
$fileValidator = new FileValidator();
$actionValidator = new ActionValidator();



$processCommand = new CSVCommand($argv, $logFile);
$processCommand->setValidator($actionValidator);
//$processCommand->setValidator($fileValidator);
$processCommand->execute();

