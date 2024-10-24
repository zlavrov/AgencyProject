<?php

declare(strict_types=1);

namespace App\Model\Error;

class ErrorValidationDetailsModel {


    /** @var ErrorValidationDetailsItemModel[] */
    private array $violations = [];

    public function addViolation(string $field, string $message): void
    {
        $this->violations[] = new ErrorValidationDetailsItemModel($field, $message);
    }

    /** @return ErrorValidationDetailsItemModel[] */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
