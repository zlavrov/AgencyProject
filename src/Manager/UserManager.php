<?php

declare(strict_types=1);

namespace App\Manager;

use App\Repository\UserRepository;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserManager extends BaseManager
{
    public function __construct(
        protected readonly UserRepository $repository,
        private readonly TranslatorInterface $translator,
    ) {
    }
}
