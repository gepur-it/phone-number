<?php
/**
 * @author : Marina Mileva m934222258@gmail.com
 * @since : 03.05.18
 */

namespace GepurIt\PhoneNumber;

/**
 * Class PhoneNumber
 * @package GepurIt\PhoneNumber
 */
class PhoneNumber
{
    /** @var string fullNumber */
    private $fullNumber;

    /**
     * PhoneNumber constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $number = mb_strcut($number, 0, PhoneNumberDoctrineType::TYPE_LENGTH);
        $this->fullNumber = preg_replace("/[^0-9]/", "", $number);

        if (isset($number[0]) && in_array($number[0], ['+', '*'])) {
            $this->fullNumber = $number[0].$this->fullNumber;
        }
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->fullNumber;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->fullNumber;
    }
}