<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class StringConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!(strlen($value) > 1 && strlen($value) < 20)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
