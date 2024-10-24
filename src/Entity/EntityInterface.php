<?php

declare(strict_types=1);

namespace App\Entity;

use App\Model\ModelInterface;

interface EntityInterface
{
    public function getModel(): ModelInterface;
}
