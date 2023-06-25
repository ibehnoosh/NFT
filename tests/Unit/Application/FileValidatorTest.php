<?php

use App\Application\Exceptions\InvalidArgumentExceptionValidator;
use App\Application\Validators\FileValidator;
use PHPUnit\Framework\TestCase;

class FileValidatorTest extends TestCase
{
    private FileValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new FileValidator();
    }

    public function testValidateWithValidFile(): void
    {
        $validData = ['2' => 'tests/Unit/testFiles/csv.csv'];
        $isValid = $this->validator->validate($validData);
        $this->assertTrue($isValid);
    }

    public function testValidateWithMissingFileArgument(): void
    {
        $missingData = [];
        $this->expectException(InvalidArgumentExceptionValidator::class);
        $this->validator->validate($missingData);
    }

    public function testValidateWithNonExistentFile(): void
    {
        $nonExistentData = ['2' => 'not_exist.csv'];
        $this->expectException(InvalidArgumentExceptionValidator::class);
        $this->validator->validate($nonExistentData);
    }

    public function testValidateWithInvalidFileExtension(): void
    {
        $invalidExtensionData = ['2' => 'tests/Unit/testFiles/invalid.txt'];
        $this->expectException(InvalidArgumentExceptionValidator::class);
        $this->validator->validate($invalidExtensionData);
    }
}
