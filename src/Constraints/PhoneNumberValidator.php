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
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

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
        if (!$constraint instanceof PhoneNumber) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\PhoneNumber');
        }

        if (null === $value) {
            $this->context->buildViolation($constraint->null)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (empty($value)) {
            $this->context->buildViolation($constraint->blank)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (mb_strlen($value) < 10) {
            $this->context->buildViolation($constraint->less)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        if (mb_strlen($value) > 12) {
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