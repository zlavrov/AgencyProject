<?php

declare(strict_types=1);

namespace App\Model\Error;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

readonly class ErrorResponseModel {

    public function __construct(private string $message, private mixed $details = null) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    #[Property(
        type: 'object',
        oneOf: [
            new Schema(type: 'array', items: new Items(type: 'string')),
            new Schema(ref: new Model(type: ErrorValidationDetailsModel::class)),
        ]
    )]
    public function getDetails(): mixed
    {
        return $this->details;
    }
}
