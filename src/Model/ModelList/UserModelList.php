<?php

declare(strict_types=1);

namespace App\Model\ModelList;

use App\Model\UserModel;
use App\Security\AccessGroup;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use Symfony\Component\Serializer\Annotation\Groups;

class UserModelList implements ModelListInterface {
    
    #[Property(type: 'array', items: new Items(new Model(type: UserModel::class, groups: [AccessGroup::USER_READ])))]
    #[Groups(groups: [
        AccessGroup::USER_READ,
    ])]
    /** @var array<int, UserModel> */
    public ?array $data;

    #[Groups(groups: [
        AccessGroup::USER_READ,
    ])]
    public MetaModel $meta;
}
