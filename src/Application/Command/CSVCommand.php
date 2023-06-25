<?php
namespace App\Application\Command;

use App\Application\Contracts\Command;
use App\Application\Contracts\ValidatorInterface;
use App\Infrastructure\FileIO\CsvFileReader;
use App\Infrastructure\FileIO\CsvFileWriter;
use App\Infrastructure\Logger\FileLogger;

class CSVCommand implements Command
{
    CONST CALC_URL= 'App\Domain\Calculator\\';

    private string $logMessage = '';
    /**
     * @var array<mixed> $results
     */
    private array $results = [];
    /**
     * @var array<mixed>  $validators
     */
    private array $validators = [];
    private string $action;
    private string $file;
    private string $resultFile;
    private string $logFile;


    /**
     * @param   array<mixed> $request
     */

    public function __construct(
        public array $request
    )
    {
        $this->action = $request[1] ?? '';
        $this->file = $request[2] ?? '';
        $this->resultFile = FILES.'result.csv';
        $this->logFile = FILES.'log.csv';
    }

    public function execute(): void
    {
        /**
         * @param   array<mixed> $this->request
         */

        $this->validateRequest($this->request);

        $rows = $this->readCsvFile($this->file);

        foreach ($rows as $row) {
            $result = $this->performAction($row);
            $this->handleResult($result, $row);
        }

        $this->saveLog();
        $this->writeResultsToCsv($this->results);

    }

    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validators[] = $validator;
    }

    private function validateRequest(array $request)
    {
        foreach ($this->validators as $validator) {
            $validator->validate($request);
        }
    }

    private function handleResult(?int $result, array $row): void
    {
        if ($result > 0) {
            $this->results[] = array_merge($row, [$result]);
        } elseif (is_null($result)) {
            $this->log("Numbers are {$row[0]} and {$row[1]} are wrong, is not allowed");
        } else {
            $this->log("Numbers are {$row[0]} and {$row[1]} are wrong");
        }
    }

    private function readCsvFile(string $file): array
    {
        $rows = CsvFileReader::readFile($file);
        return $rows;
    }

    private function performAction(array $nums): ?int
    {
        $result = call_user_func(
            self::CALC_URL."$this->action::calculate",
            intval($nums[0]),
            intval($nums[1])
        );
        return $result;
    }

    private function log($message): void
    {
        $this->logMessage .= $message.PHP_EOL;
    }

    private function saveLog(): void
    {
        FileLogger::log($this->logFile , $this->logMessage);
    }

    private function writeResultsToCsv($results): void
    {
        CsvFileWriter::writeFile($this->resultFile , $results);
    }
}