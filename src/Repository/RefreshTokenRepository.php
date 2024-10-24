<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\RefreshToken;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Gesdinet\JWTRefreshTokenBundle\Doctrine\RefreshTokenRepositoryInterface;

/**
 * @extends ServiceEntityRepository<RefreshToken>
 */
class RefreshTokenRepository extends ServiceEntityRepository implements RefreshTokenRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RefreshToken::class);
    }

    public function findInvalidUserToken($username, $datetime = null)
    {
        $query = $this->createQueryBuilder(alias: 'r');
        if(!$datetime) {
            $datetime = new DateTime();
        }

        $query->where(predicates: 'r.valid < :now')->setParameter(key: 'now', value: $datetime);

        if($username) {
            $query->andWhere(where: 'r.username = :username')->setParameter(key: 'username', value: $username);
        }

        return $query->getQuery()->getResult();
    }

    public function findUserToken($username, $datetime = null)
    {
        $query = $this->createQueryBuilder(alias: 'r');
        if(!$datetime) {
            $datetime = new DateTime();
        }

        $query->where(predicates: 'r.valid > :now')->setParameter(key: 'now', value: $datetime);

        if($username) {
            $query->andWhere(where: 'r.username = :username')->setParameter(key: 'username', value: $username);
        }

        $query->orderBy(sort: 'r.valid', order: 'DESC')->setMaxResults(maxResults: 1);

        return $query->getQuery()->getOneOrNullResult();
    }

    public function findInvalid($datetime = null): array
    {
        $query = $this->createQueryBuilder(alias: 'r');

        if(!$datetime) {
            $datetime = new DateTime();
        }

        $query->where(predicates: 'r.valid < :now')->setParameter(key: 'now', value: $datetime);

        return $query->getQuery()->getResult();
    }
}
