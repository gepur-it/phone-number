<?php
/**
 * @author: Marina Mileva m934222258@gmail.com
 * @since: 17.05.18 16:05
 */

namespace GepurIt\PhoneNumber;

use PHPUnit\Framework\TestCase;

class PhoneNumberHelperTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testIsUkrainianNumberFalse($assertion, $number)
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals($assertion, $helper->isUkrainianNumber(new PhoneNumber($number)));
    }

    /**
     * @dataProvider cutDataProvider
     */
    public function testIsCutUkrainian($assertion, $number)
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals($assertion, $helper->isCutUkrainian(new PhoneNumber($number)));
    }

    public function testConvertToE164IfUkrainian()
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals(
            '01111111111111111',
            $helper->convertToE164IfUkrainian(new PhoneNumber('01111111111111111'))
        );
    }

    public function testConvertToE164IfUkrainian11()
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals('380979979485', $helper->convertToE164IfUkrainian(new PhoneNumber('00979979485')));
    }

    public function testConvertToE164IfUkrainian10()
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals('380979979485', $helper->convertToE164IfUkrainian(new PhoneNumber('0979979485')));
    }

    public function testConvertToE164IfUkrainian9()
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals('380979979485', $helper->convertToE164IfUkrainian(new PhoneNumber('979979485')));
    }

    public function testConvertToE164IfUkrainianSkip()
    {
        $helper = new PhoneNumberHelper();
        $this->assertEquals('380979979485', $helper->convertToE164IfUkrainian(new PhoneNumber('380979979485')));
    }

    /**
     * @return array
     */
    public function cutDataProvider()
    {
        return [
            [false, '000'],
            [false, '01111111111111111'],
            [true, '380383803808'],
            [true, '0979979485'],
        ];
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            'invalid number'                                            => [false, '00000000'],
            'russian number'                                            => [false, '789456123457'],
            'ukrainian, but invalid number, should be false'            => [false, '3801234567'],
            'ukrainian with plus, but invalid, should be false'         => [false, '+38012345678'],
            'technical number'                                          => [false, '*4578'],
            'valid ukrainian number, starts with zero and contains ()-' => [true, '(038) 380-38-08'],
            'valid ukrainian number, starts with zero and contains ()'  => [true, '(038) 380 3808'],
            'valid ukrainian number, starts with zero'                  => [true, '038 3803808'],
            'valid number, start with eight'                            => [true, '80383803808'],
            'valid number, start with three'                            => [true, '380383803808'],
            'valid number, starts with plus'                            => [true, '+380253803808'],
            'valid number, starts with plus and contains ()-'           => [true, '+38(025)380-38-08'],
        ];
    }
}