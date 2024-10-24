<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class PasswordStrengthValidator extends ConstraintValidator
{
    public function validate(#[\SensitiveParameter] mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof PasswordStrength) {
            throw new UnexpectedTypeException($constraint, PasswordStrength::class);
        }

        if (null === $value) {
            return;
        }

        if (!\is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!$this->estimatesStrength($value)) {
            $this->context->buildViolation($constraint->massage)->addViolation();
        }
    }

    private function estimatesStrength(#[\SensitiveParameter] string $password): bool
    {
        // length
        if (\strlen($password) > 64 || \strlen($password) < 8) {
            return false;
        }

        if (preg_match('/[a-zA-Z]/', $password)) {

            // lower case letters
            if (!preg_match('/[a-z]/', $password)) {
                return false;
            }

            // UPPER case letters
            if (!preg_match('/[A-Z]/', $password)) {
                return false;
            }
        }

        // numbers123
        if (!preg_match('/\d+/', $password)) {
            return false;
        }

        // special chars !@#$%^&*_
        if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
            return false;
        }

        return true;
    }
}
