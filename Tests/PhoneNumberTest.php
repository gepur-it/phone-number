<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 05.06.18
 * Time: 13:51
 */

namespace GepurIt\PhoneNumber;

use PHPUnit\Framework\TestCase;

/**
 * Class PhoneNumberTest
 * @package GepurIt\PhoneNumber\Tests
 */
class PhoneNumberTest extends TestCase
{
    public function testGetNumber()
    {
        $phone = new PhoneNumber('3809777777777');
        $this->assertEquals('3809777777777', $phone->getNumber());
    }

    public function testToString()
    {
        $phone = new PhoneNumber('3809777777777');
        $this->assertEquals('3809777777777', sprintf('%s', $phone));
    }
}