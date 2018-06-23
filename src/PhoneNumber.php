<?php
/**
 * @author : Marina Mileva m934222258@gmail.com
 * @since : 03.05.18
 */

namespace GepurIt\PhoneNumber;
use GepurIt\PhoneNumber\Constraints as Assert;

/**
 * Class PhoneNumber
 * @package GepurIt\PhoneNumber
 */
class PhoneNumber
{
    /**
     * @var string fullNumber
     * @Assert\PhoneNumber()
     */
    private $fullNumber;

    /**
     * PhoneNumber constructor.
     * @param string $number
     */
    public function __construct(string $number)
    {
        $number = preg_replace("/[^0-9]/", "", $number);
        $this->fullNumber = mb_strcut($number, 0, PhoneNumberDoctrineType::TYPE_LENGTH);
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