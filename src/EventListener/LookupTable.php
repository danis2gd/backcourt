<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Interfaces\LookupInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;

class LookupTable
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        if (!$entity instanceof LookupInterface) {
            dump($entity);
            return;
        }


    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        // if this listener only applies to certain entity types,
        // add some code to check the entity type as early as possible
        dump($entity);
    }

    public function onFlush(OnFlushEventArgs $args) {
        $entityManager = $args->getEntityManager();
        foreach ($entityManager->getUnitOfWork()->getScheduledEntityInsertions() as $key => $entity) {
            if (!$entity instanceof LookupInterface) {
                continue;
            }

            $persistedEntity = $entityManager->getRepository(get_class($entity))
                ->findOneBy([
                    'handle' => $entity->getHandle()
                ]);

            if (null === $persistedEntity) {
                throw new \InvalidArgumentException(
                    sprintf('Entity does not exist for %s', get_class($entity))
                );
            }

            $entity->setId($persistedEntity->getId());

            $entityManager->clear(get_class($entity));
        }
    }
}