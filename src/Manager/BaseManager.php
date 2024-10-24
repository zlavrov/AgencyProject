<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\EntityInterface;
use App\Model\ModelInterface;
use App\Repository\BaseRepository;
use Doctrine\ORM\EntityRepository;
use UnexpectedValueException;

use function PHPUnit\Framework\returnSelf;

abstract class BaseManager {

    use AutoMapper;

    public function getRepository(): BaseRepository
    {
        $exception = new UnexpectedValueException(message: 'Repository not set on constructor');

        return property_exists(object_or_class: $this, property: 'repository') ? $this->repository ?? throw $exception : throw $exception;
    }

    public function getRepositoryObject(string $entityName): EntityRepository
    {
        return $this->getRepository()->getRepositoryObject(entityName: $entityName);
    }

    public function getList(): array
    {
        return $this->getRepository()->findAll();
    }

    /**
     * @throws \ReflectionException
     */
    public function create(ModelInterface $model, string $accessGroup): EntityInterface
    {
        $entity = $this->mapToEntity(model: $model, accessGroup: $accessGroup);
        $this->save($entity);

        return $entity;
    }

    /**
     * @throws \ReflectionException
     */
    public function update(ModelInterface $model, string $accessGroup, EntityInterface $entity): EntityInterface
    {
        $entity = $this->mapToEntity(model: $model, accessGroup: $accessGroup, entity: $entity);
        $this->save($entity);

        return $entity;
    }

    public function findEntity(int $id)
    {
        return $this->getRepository()->findOneBy(criteria: ['id' => $id]);
    }

    public function findBy(array $filter): array
    {
        return $this->getRepository()->findBy(criteria: $filter);
    }

    public function findOneBy(array $filter)
    {
        return $this->getRepository()->findOneBy(criteria: $filter);
    }

    public function delete(EntityInterface $entity, bool $flush = true): void
    {
        $this->getRepository()->remove(entity: $entity, flush: $flush);
    }

    public function save(EntityInterface $entity, bool $flush = true): EntityInterface
    {
        $this->getRepository()->save(entity: $entity, flush: $flush);

        return $entity;
    }

    public function flush(): void
    {
        $this->getRepository()->flush();
    }
}
