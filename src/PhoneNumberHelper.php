<?php
/**
 * @author: Marina Mileva m934222258@gmail.com
 * @since: 16.05.18 17:40
 */

namespace GepurIt\PhoneNumber;

/**
 * Class PhoneNumberHelper
 * @package GepurIt\PhoneNumber
 */
class PhoneNumberHelper
{
    const UA_REGEXP = '/^\+?3?8?(0\d{9})/';
    const PHONE_CODES_UKRAINE = [
        '039', '067', '068', '096', '097', '098',   // Kyivstar
        '050', '066', '095', '099',                 // MTC
        '063', '071', '073', '093',                 // Life
        '091',                                      // Utel
        '092',                                      // Peoplenet
        '094',                                      // Intertelecom
        '043',  // Vinnitza
        '056',  // Dnepr
        '062',  // Donetzk
        '041',  // Zhitomir
        '061',  // Zaporozhie
        '034',  // Ivano-Frankovsk
        '045',  // Kyiv oblast
        '044',  // Kyiv city
        '052',  // Kripivnitzkiy
        '064',  // Lugansk
        '033',  // Lutzk
        '032',  // Lviv
        '051',  // Mykolaiv
        '048',  // Odesa
        '053',  // Poltava
        '036',  // Rovno
        '069',  // Sevastopol
        '065',  // Simferopol
        '054',  // Sumy
        '035',  // Ternopil
        '031',  // Uzhgorod
        '057',  // Kharkiv
        '055',  // Kherson
        '038',  // Khmelnitzkyi
        '047',  // Cherkassy
        '046',  // Chernigov
        '037',  // Chernovtzy
    ];

    /**
     * @param PhoneNumber $phoneNumber
     * @return false|int
     */
    public function isUkrainianNumber(PhoneNumber $phoneNumber)
    {
        return preg_match(self::UA_REGEXP, $phoneNumber->getNumber());
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @return bool
     */
    public function isCutUkrainian(PhoneNumber $phoneNumber)
    {
        $number = $phoneNumber->getNumber();
        if (
            ((int)$number == 0)
            || (substr($number, 0, 2) == "00") && (strlen($number) < 11)
            || ((substr($number, 0, 1) == "0") && (strlen($number) > 11))
            || strlen($number) < 9
        ) {
            return false;
        }

        return true;
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @return string
     */
    public function convertToE164IfUkrainian(PhoneNumber $phoneNumber)
    {
        if(!$this->isCutUkrainian($phoneNumber)) {
            return $phoneNumber->getNumber();
        }

        $number = $phoneNumber->getNumber();

        // since Asterisk cuts the international output for Ukrainian numbers,
        // we process them - adding 38 or 380 (and non-Ukrainian ones count as it is)
        if (
            substr($number, 0, 2) == "00"
            && strlen($number) == 11
            && in_array(substr($number, 1, 3), self::PHONE_CODES_UKRAINE)
        ) {
            $number = substr($number, 1);
            return '38'.$number;
        }

        if ((strlen($number) == 10) &&
            in_array(substr($number, 0, 3), self::PHONE_CODES_UKRAINE)
        ) {
            return '38'.$number;
        }

        if ((strlen($number) == 9) &&
            in_array('0'.substr($number, 0, 2), self::PHONE_CODES_UKRAINE)
        ) {
            return '380'.$number;
        }

        return $number;
    }
}