<?php
/**
 * @author: Marina Mileva m934222258@gmail.com
 * @since: 04.05.18 12:06
 */

namespace GepurIt\PhoneNumber;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;

/**
 * phone_number Doctrine mapping
 *
 * Class PhoneNumberDoctrineType
 * @package GepurIt\PhoneNumber
 */
class PhoneNumberDoctrineType extends Type
{
    const TYPE_NAME = 'phone_number';
    const TYPE_LENGTH = 20;

    /**
     * @param $value
     * @param AbstractPlatform $platform
     * @return mixed|null|string
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof PhoneNumber) {
            throw new ConversionException('Expected '. PhoneNumber::class.', got ' . gettype($value));
        }

        /** @var PhoneNumber $value */
        $stringToSave = $value->getNumber();

        return $stringToSave;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return PhoneNumber
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value || $value instanceof PhoneNumber) {
            return $value;
        }

        $result = null;
        $phone = parent::convertToPHPValue($value, $platform);

        if(is_string($value)) {
            $result = new PhoneNumber($phone);
        }

        return $result;
    }

    /**
     * Gets the SQL declaration snippet for a field of this type.
     *
     * @param array                                     $fieldDeclaration The field declaration.
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform         The currently used database platform.
     *
     * @return string
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR('.self::TYPE_LENGTH.')';
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $e = explode('\\', get_class($this));

        return str_replace('DoctrineType', '', end($e));
    }

    /**
     * Gets the name of this type.
     *
     * @return string
     */
    public function getName()
    {
        return self::TYPE_NAME;
    }
}