<?php

declare(strict_types=1);

namespace App\Model;

use App\Entity\EntityInterface;
use App\Model\ModelList\ModelListInterface;
use Symfony\Component\Serializer\Attribute\Ignore;

interface ModelInterface
{
    #[Ignore]
    public function getEntity(): EntityInterface;

    #[Ignore]
    public function getModelList(): ModelListInterface;
}
