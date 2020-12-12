<?php

namespace App\Test\Util;

use App\Exception\ItemNotFoundException;
use App\Util\Math;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testItCanReturnTheCorrectQuotientAndReminder()
    {
        $response = Math::getQuotientAndReminder(10, 3);

        $this->assertEquals($response[0], 3);

        $this->assertEquals($response[1], 1);
    }

    public function testItCanReturnTheCorrectQuotientAndReminderWhenDividedByLargerNumber()
    {
        $response = Math::getQuotientAndReminder(3, 6);

        $this->assertEquals($response[0], 0);

        $this->assertEquals($response[1], 3);
    }

    public function testItCanReturnTheCorrectQuotientAndReminderWhenItemsInCartIsZero()
    {
        $response = Math::getQuotientAndReminder(0, 3);

        $this->assertEquals($response[0], 0);
        $this->assertEquals($response[1], 0);
    }

    public function testItCanThrowExceptionWhenOfferApplicabeItemIsZero()
    {
        $this->expectException(\InvalidArgumentException::class);
        Math::getQuotientAndReminder(3, 0);
    }
}