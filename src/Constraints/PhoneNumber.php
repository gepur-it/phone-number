<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 22.06.18
 * Time: 15:26
 */

namespace GepurIt\PhoneNumber\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PhoneNumber extends Constraint
{
    public $nullMessage = 'The PhoneNumber can`t be null.';
    public $numericMessage = 'The PhoneNumber "{{ string }}" must be numeric.';
    public $minLengthMessage = 'The PhoneNumber "{{ string }}" length must be grater or equals than {{ minLength }} symbols.';
    public $maxLengthMessage = 'The PhoneNumber "{{ string }}" length must be less or equals  than {{ maxLength }} symbols.';
    public $minLength = 10;
    public $maxLength = 12;

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return [
            self::CLASS_CONSTRAINT,
            self::PROPERTY_CONSTRAINT,
        ];
    }
}
