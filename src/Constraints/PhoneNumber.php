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
    public $invalid = 'The data nuber "{{ string }}" is not PhoneNumber.';
    public $null = 'The PhoneNumber "{{ string }}" can`t be null.';
    public $blanc = 'The PhoneNumber "{{ string }}" can`t be blanc.';
    public $numeric = 'The PhoneNumber "{{ string }}" must be numeric.';
    public $less = 'The PhoneNumber "{{ string }}" must be grater than 10 symbols.';
    public $grater = 'The PhoneNumber "{{ string }}" must be less than 12 symbols.';
}