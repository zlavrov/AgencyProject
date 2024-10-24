<?php

declare(strict_types=1);

namespace App\Model\ModelList;

class EmptyListModel implements ModelListInterface
{
    public ?array $data = [];

    public MetaModel $meta;
}
