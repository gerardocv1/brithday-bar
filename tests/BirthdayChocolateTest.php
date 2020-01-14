<?php

use PHPUnit\Framework\TestCase;
use src\BirthdayChocolate;

class BirthdayChocolateTest extends TestCase
{
    /**
     * test success birthday
     */
    public function testSuccessBirthday()
    {
        $class = new BirthdayChocolate(5, "1 2 1 3 2", "3 2");
        $response = $class->birthday();
        $this->assertEquals(1, $response->status);
        $this->assertEquals(2, $response->data);
    }

    /**
     * test empty day or month
     */
    public function testEmptyDayMonthBirthday()
    {
        $class = new BirthdayChocolate(5, "1 2 1 3 2", "2");
        $response = $class->birthday();
        $this->assertEquals(-2, $response->status);
    }

    /**
     * test empty numbers chocolate squares
     */
    public function testEmptyNumberChocolateSquaresBirthday()
    {
        $class = new BirthdayChocolate(5, "", "3 2");
        $response = $class->birthday();
        $this->assertEquals(-1, $response->status);
    }

    /**
     * validate number of squares in the chocolate bar
     */
    public function testValidateNumberSquaresInChocolateBirthday()
    {
        $class = new BirthdayChocolate(6, "1 2 1 2", "3 2");
        $response = $class->birthday();
        $this->assertEquals(-3, $response->status);
    }
}
