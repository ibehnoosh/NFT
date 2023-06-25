<?php

use App\Application\Command\CSVCommand;
use App\Application\Validators\ActionValidator;
use App\Application\Validators\FileValidator;

require __DIR__.'/vendor/autoload.php';

define('FILES', __DIR__ . '/Files/');


$fileValidator = new FileValidator();
$actionValidator = new ActionValidator();

$processCommand = new CSVCommand($argv);
$processCommand->setValidator($actionValidator);
$processCommand->setValidator($fileValidator);
$processCommand->execute();

