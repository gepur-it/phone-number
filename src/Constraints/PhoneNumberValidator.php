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
            $this->context->buildViolation($constraint->nullMessage)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }

        $minLength = $payLoad->minLength??$constraint->minLength;
        if (mb_strlen($value) < $minLength) {
            $this->context->buildViolation($constraint->minLengthMessage)
                ->setParameter('{{ string }}', $value)
                ->setParameter('{{ minLength }}', $minLength)
                ->addViolation();
        }

        $maxLength = $payLoad->maxLength??$constraint->maxLength;
        if (mb_strlen($value) > $maxLength) {
            $this->context->buildViolation($constraint->maxLengthMessage)
                ->setParameter('{{ string }}', $value)
                ->setParameter('{{ maxLength }}', $maxLength)
                ->addViolation();
        }

        if (!preg_match('/^([0-9\s\-\+\(\)]*)$/', $value, $matches)) {
            $this->context->buildViolation($constraint->numericMessage)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
