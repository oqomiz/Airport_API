<?php

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class StringConstraint extends Constraint
{
    public $message = "la taille doit être comprise entre 1 et 20 caractères";
}
