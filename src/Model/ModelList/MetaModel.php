<?php

declare(strict_types=1);

namespace App\Model\ModelList;

use App\Security\AccessGroup;
use Symfony\Component\Serializer\Attribute\Groups;

class MetaModel
{
    #[Groups(groups: [
        AccessGroup::USER_READ,
        AccessGroup::AGENT_READ,
        AccessGroup::AGENCY_READ,
        AccessGroup::DEPARTMENT_READ,
        AccessGroup::OCCUPATION_READ,
    ])]
    public int $totalCount;
}