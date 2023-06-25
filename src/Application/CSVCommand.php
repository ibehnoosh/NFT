<?php

namespace App\Application;

use App\Application\Contracts\Command;
use App\Application\Contracts\ValidatorInterface;
use App\Infrastructure\Contracts\LoggerInterface;
use App\Infrastructure\FileIO\CsvFileReader;
use App\Infrastructure\FileIO\CsvFileWriter;

class CSVCommand implements Command
{
    CONST CALC_URL= 'App\Domain\Calculator\\';

    private string $logMessage = '';
    private array $results = [];
    private array $validators = [];
    private string $action;
    private string $file;
    private string $resultFile;

    public function __construct(
        public array $request,
        public LoggerInterface $logFile,
    )
    {
        $this->action = $request[1] ?? '';
        $file = $request[2] ?? '';
        $this->resultFile = FILES.'result.csv';
        $this->file = FILES.$file;
    }

    public function execute()
    {
        $this->validateRequest($this->request);
/*
        $rows = $this->readCsvFile($this->file);

        foreach ($rows as $row) {
            $result = $this->performAction($row);
            $this->handleResult($result, $row);
        }

        $this->saveLog();
        $this->writeResultsToCsv($this->results);
*/

    }

    public function setValidator(ValidatorInterface $validator)
    {
        $this->validators[] = $validator;
    }
    private function validateRequest($request)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($request);
        }
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