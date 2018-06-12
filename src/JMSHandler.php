<?php
/**
 * @author: Andrii yakovlev <yawa20@gmail.com>
 * @since: 29.05.18
 */

namespace GepurIt\PhoneNumber\src;

use GepurIt\PhoneNumber\PhoneNumber;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\XmlDeserializationVisitor;

/**
 * Class JMSHandler
 * @package GepurIt\PhoneNumber
 * @codeCoverageIgnore
 */
class JMSHandler implements SubscribingHandlerInterface
{
    /**
     * Return format:
     *
     *      [
     *          [
     *              'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
     *              'format' => 'json',
     *              'type' => 'DateTime',
     *              'method' => 'serializeDateTimeToJson',
     *          ],
     *      ]
     *
     * The direction and method keys can be omitted.
     *
     * @return array
     */
    public static function getSubscribingMethods()
    {
        $methods = [];

        foreach (['json', 'xml', 'yml'] as $format) {
            $methods[] = [
                'type'      => PhoneNumber::class,
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format'    => $format,
            ];
            $methods[] = [
                'type'      => PhoneNumber::class,
                'format'    => $format,
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method'    => 'serializePhoneNumber',
            ];
        }

        return $methods;
    }

    /**
     * @param VisitorInterface $visitor
     * @param PhoneNumber $number
     * @param array $type
     * @param Context $context
     * @return string
     */
    public function serializePhoneNumber(
        VisitorInterface $visitor,
        PhoneNumber $number,
        array $type,
        Context $context
    ) {
        return $number->getNumber();
    }

    /**
     * @param XmlDeserializationVisitor $visitor
     * @param $data
     * @param array $type
     * @return PhoneNumber|null
     */
    public function deserializePhoneNumberFromXml(XmlDeserializationVisitor $visitor, $data, array $type)
    {
        return new PhoneNumber($data);
    }

    /**
     * @param JsonDeserializationVisitor $visitor
     * @param $data
     * @param array $type
     * @return PhoneNumber|null
     */
    public function deserializePhoneNumberFromJson(JsonDeserializationVisitor $visitor, $data, array $type)
    {
        return new PhoneNumber($data);
    }
}
