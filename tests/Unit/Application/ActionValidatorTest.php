<?php

use App\Application\Exceptions\InvalidArgumentExceptionValidator;
use App\Application\Validators\ActionValidator;
use PHPUnit\Framework\TestCase;


class ActionValidatorTest extends TestCase
{
    private ActionValidator $validator;

    protected function setUp(): void
    {
        $this->validator = new ActionValidator();
    }
    public function testValidateValidAction(): void
    {
        $data = ['1' => 'plus'];

        $result = $this->validator->validate($data);

        $this->assertTrue($result);
    }

    public function testValidateInvalidAction(): void
    {
        $this->expectException(InvalidArgumentExceptionValidator::class);

        $data = ['1' => 'invalid'];

        $this->validator->validate($data);
    }

    public function testValidateMissingAction(): void
    {
        $data = [];

        $result = $this->validator->validate($data);

        $this->assertFalse($result);
    }
}
