<?php
/**
 * Created by PhpStorm.
 * User: zogxray
 * Date: 22.06.18
 * Time: 15:27
 */

namespace GepurIt\PhoneNumber\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use \GepurIt\PhoneNumber\PhoneNumber as PhoneNumberType;
/**
 * Class IsPhoneNumberValidator
 * @package GepurIt\PhoneNumber
 */
class PhoneNumberValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof PhoneNumberType) {
            $this->context->buildViolation($constraint->invalid)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (empty($value->getNumber())) {
            $this->context->buildViolation($constraint->blanc)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (null === $value->getNumber()) {
            $this->context->buildViolation($constraint->null)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (mb_strlen($value->getNumber()) < 10) {
            $this->context->buildViolation($constraint->less)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (mb_strlen($value->getNumber()) > 12) {
            $this->context->buildViolation($constraint->grater)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (!preg_match('/^([0-9\s\-\+\(\)]*)$/', $value, $matches)) {
            $this->context->buildViolation($constraint->numeric)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}