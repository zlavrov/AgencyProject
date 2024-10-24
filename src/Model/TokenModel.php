<?php

declare(strict_types=1);

namespace App\Model;

use OpenApi\Attributes\Property;

class TokenModel
{
    #[Property(example: 'eyJ0e.....MampjZl0jc')]
    public ?string $token;
}
