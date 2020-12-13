<?php

namespace App\Test\Util;

use App\Util\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testItCanReturnTheCorrectQuotientAndReminder()
    {
        $response = Math::getQuotientAndReminder(10, 3);

        $this->assertEquals($response['quotient'], 3);

        $this->assertEquals($response['reminder'], 1);
    }

    public function testItCanReturnTheCorrectQuotientAndReminderWhenDividedByLargerNumber()
    {
        $response = Math::getQuotientAndReminder(3, 6);

        $this->assertEquals($response['quotient'], 0);

        $this->assertEquals($response['reminder'], 3);
    }

    public function testItCanReturnTheCorrectQuotientAndReminderWhenItemsInCartIsZero()
    {
        $response = Math::getQuotientAndReminder(0, 3);

        $this->assertEquals($response['quotient'], 0);
        $this->assertEquals($response['reminder'], 0);
    }

    public function testItCanThrowExceptionWhenOfferApplicabeItemIsZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        Math::getQuotientAndReminder(3, 0);
    }
}