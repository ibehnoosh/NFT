<?php

use App\Application\CSVCommand;
use App\Infrastructure\FileIO\CsvFileWriter;
use App\Infrastructure\Logging\FileLogger;

require __DIR__.'/vendor/autoload.php';

define('FILES', __DIR__ . '/Files/');

$action = $argv[1] ?? '';
$file = $argv[2] ?? '';


$logFile = new FileLogger(FILES.'log.csv');

$resultFile = FILES.'result.csv';

$processCommand = new CSVCommand($action, FILES.$file , $logFile , $resultFile);

$processCommand->execute();