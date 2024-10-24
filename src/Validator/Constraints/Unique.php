<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
final class Unique extends UniqueEntity
{
    public function validatedBy(): string
    {
        return UniqueValidator::class;
    }
}
