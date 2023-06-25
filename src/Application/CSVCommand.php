<?php

namespace App\Application;

use App\Application\Contracts\Command;
use App\Infrastructure\FileIO\CsvFileReader;
use App\Infrastructure\FileIO\CsvFileWriter;

//TODO what happen if the file is too big?

class CSVCommand implements Command
{
    CONST CALC_URL= 'App\Domain\Calculator\\';

    private string $logMessage = '';
    private array $results = [];

    public function __construct(
        public $action,
        public $file,
        public $logFile,
        public $resultFile
    )
    {
    }

    public function execute()
    {
        $rows = $this->readCsvFile($this->file);

        foreach ($rows as $row) {
            $result = $this->performAction($row);
            $this->handleResult($result, $row);
        }

        $this->saveLog();
        $this->writeResultsToCsv($this->results);

    }

    private function handleResult($result, $row)
    {
        if ($result > 0) {
            $this->results[] = array_merge($row, [$result]);
        } elseif (is_null($result)) {
            $this->log("Numbers are {$row[0]} and {$row[1]} are wrong, is not allowed");
        } else {
            $this->log("Numbers are {$row[0]} and {$row[1]} are wrong");
        }
    }

    private function readCsvFile($file)
    {
        $rows = CsvFileReader::readFile($file);
        return $rows;
    }

    private function performAction($numbers)
    {
        $result = call_user_func(self::CALC_URL."$this->action::calculate", intval($numbers[0]), intval($numbers[1]));
        return $result;
    }

    private function log($message)
    {
        $this->logMessage .= $message.PHP_EOL;
    }

    private function saveLog()
    {
        $this->logFile->log($this->logMessage);
    }

    private function writeResultsToCsv($results)
    {
        CsvFileWriter::writeFile($this->resultFile , $results);
    }
}