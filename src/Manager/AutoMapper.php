<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\EntityInterface;
use App\Model\ModelInterface;
use App\Model\ModelList\EmptyListModel;
use App\Model\ModelList\MetaModel;
use App\Model\ModelList\ModelListInterface;
use App\Model\PropertyModel;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\Extractor\SerializerExtractor;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

// use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;

// use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;

trait AutoMapper {

    /**
     * @throws \ReflectionException
     */
    public function mapToEntity(ModelInterface $model, string $accessGroup, EntityInterface $entity = null): EntityInterface
    {
        if (!$entity && isset($model->id)) {
            $entity = $this->getRepositoryObject($model->getEntity()::class)->find($model->id);
            if (!$entity) {
                throw new \LogicException(
                    sprintf('Entity \'%s\' with id -%s not found', $model->getEntity()::class, $model->id)
                );
            }
        }
        $entity = $entity ?: $model->getEntity();

        $props = $this->getPropertiesWithTypesAndGroups($model, $accessGroup, true);
        /** @var PropertyModel $property */
        foreach ($props as $property) {

            $setter = $this->getSetterMethod($entity, $property->name);
            $value = $model->{$property->name};
            if (is_array($value)) {
                $valueArray = new ArrayCollection();
                foreach ($value as $item) {
                    $valueArray->add($this->mapToEntity($item, $accessGroup));
                }
                $value = $valueArray;
            } elseif ($property->model) {
                $value = $this->mapToEntity($value, $accessGroup);
            }
            $entity->{$setter}($value);
        }


        return $entity;
    }

    /**
     * @throws \ReflectionException
     */
    public function mapToModel(EntityInterface $entity, string $accessGroup): ModelInterface
    {
        $model = $entity->getModel();
        $props = $this->getPropertiesWithTypesAndGroups($model, $accessGroup, false);

        /** @var PropertyModel $property */
        foreach ($props as $property) {
            $getter = $this->getGetterMethod($entity, $property->name);
            $value = $entity->{$getter}();
            if ($value instanceof Collection) {
                $valueArray = [];
                foreach ($value as $item) {
                    $valueArray[] = $this->mapToModel($item, $accessGroup);
                }
                $model->{$property->name} = $valueArray;
            } elseif ($property->model && $value) {
                $model->{$property->name} = $this->mapToModel($value, $accessGroup);
            } else {
                $model->{$property->name} = $value;
            }
        }

        return $model;
    }

    /**
     * @throws \ReflectionException
     */
    private function getPropertiesWithTypesAndGroups(ModelInterface $model, string $accessGroup, bool $checkInitialized): array
    {
        $serializerClassMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $serializerExtractor = new SerializerExtractor($serializerClassMetadataFactory);

        $reflectionExtractor = new ReflectionExtractor();

        $props = $serializerExtractor->getProperties($model::class, ['serializer_groups' => [$accessGroup]]);

        $list = [];

        foreach ($props as $prop) {

            $refProperty = new ReflectionProperty($model::class, $prop);

            if ($checkInitialized && !$refProperty->isInitialized($model)) {
                continue;
            }
            if ($refProperty->isPrivate()) {
                continue;
            }

            $property = new PropertyModel();
            $property->name = $prop;
            $propertyType = current($reflectionExtractor->getTypes($model::class, $prop));
            if (
                Type::BUILTIN_TYPE_OBJECT == $propertyType->getBuiltinType()
                && !enum_exists($propertyType->getClassName())
            ) {
                if (new ($propertyType->getClassName())() instanceof ModelInterface) {
                    if ($checkInitialized) {
                        if (!is_null($model->{$prop})) {
                            $property->model = true;
                        }
                    } else {
                        $property->model = true;
                    }
                }
            }
            $list[] = $property;
        }

        return $list;
    }

    protected function getGetterMethod(EntityInterface $entity, string $property): ?string
    {
        $getters = [
            'get'.ucfirst($property),
            'is'.ucfirst($property),
            'has'.ucfirst($property),
        ];

        return $this->validateMethod($entity, $getters);
    }

    private function getSetterMethod(EntityInterface $entity, string $property): ?string
    {
        $setters = [
            'set'.ucfirst($property),
        ];

        return $this->validateMethod($entity, $setters);
    }

    private function validateMethod(EntityInterface $entity, array $methods): ?string
    {
        $availableMethods = array_filter($methods, static fn (string $method): bool => method_exists($entity, $method));
        if (count($availableMethods) > 1) {
            throw new \LogicException(
                sprintf('Entity class \'%s\' has multiple same methods - this is insane!', $entity::class)
            );
        }

        $method = current($availableMethods);
        if (!$method) {
            throw new \BadMethodCallException(
                sprintf(
                    'Entity class \'%s\' does not have method. Available methods - \'%s\'',
                    $entity::class,
                    implode(',', $methods)
                )
            );
        }

        return $method;
    }

    /**
     * @throws \ReflectionException
     */
    public function mapToListModel(array $entities, string $accessGroup): ModelListInterface
    {
        $listModel = new EmptyListModel();
        $changeListModel = true;
        /** @var EntityInterface $entity */
        foreach ($entities as $entity) {
            if ($changeListModel) {
                $listModel = $entity->getModel()->getModelList();
                $changeListModel = false;
            }
            $listModel->data[] = $this->mapToModel($entity, $accessGroup);
        }

        $metaModel = new MetaModel();
        $metaModel->totalCount = count($entities);
        $listModel->meta = $metaModel;

        return $listModel;
    }
}
