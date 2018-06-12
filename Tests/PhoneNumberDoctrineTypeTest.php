<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 05.06.18
 * Time: 14:49
 */

namespace GepurIt\PhoneNumber;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

/**
 * Class PhoneNumberDoctrineTypeTest
 * @package GepurIt\PhoneNumber\Tests
 */
class PhoneNumberDoctrineTypeTest extends TestCase
{
    /**
     * @var PhoneNumberDoctrineType
     */
    protected $type;

    /**
     * @throws DBALException
     */
    public static function setUpBeforeClass()
    {
        Type::addType(PhoneNumberDoctrineType::TYPE_NAME, PhoneNumberDoctrineType::class);
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(PhoneNumberDoctrineType::class, $this->type);
    }

    public function testGetName()
    {
        $this->assertSame(PhoneNumberDoctrineType::TYPE_NAME, $this->type->getName());
    }

    public function testGetSQLDeclaration()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertSame('VARCHAR(20)', $this->type->getSQLDeclaration([], $platform));
    }

    public function testToString()
    {
        $this->assertSame('PhoneNumber', sprintf('%s', $this->type));
    }

    /**
     * @throws ConversionException
     */
    public function testConvertToDatabaseValueWithNull()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertNull($this->type->convertToDatabaseValue(null, $platform));
    }

    /**
     * @throws ConversionException
     */
    public function testConvertToDatabaseValueException()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->expectException(ConversionException::class);

        $this->type->convertToDatabaseValue(new \stdClass(), $platform);
    }

    /**
     * @throws ConversionException
     */
    public function testConvertToDatabaseValue()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $result = $this->type->convertToDatabaseValue(new PhoneNumber('3809777777777'), $platform);

        $this->assertEquals('3809777777777', $result);
    }

    public function testConvertToPHPValueWithNull()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertNull($this->type->convertToPHPValue(null, $platform));
    }

    public function testConvertToPHPValueWithNullEmail()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertInstanceOf(
            PhoneNumber::class,
            $this->type->convertToPHPValue(new PhoneNumber('3809777777777'), $platform)
        );
    }

    public function testConvertToPHPValue()
    {
        /**@var AbstractPlatform|\PHPUnit_Framework_MockObject_MockObject $platform */
        $platform = $this->createMock(AbstractPlatform::class);

        $this->assertInstanceOf(PhoneNumber::class, $this->type->convertToPHPValue('3809777777777', $platform));
    }

    /**
     * @throws DBALException
     */
    protected function setUp()
    {
        $this->type = Type::getType(PhoneNumberDoctrineType::TYPE_NAME);
    }
}