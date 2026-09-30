<?php

namespace App\Trait;

trait EntityRepositorySaverTrait
{
    public function persist(object $entity):void
    {
        #@phpstan-ignore-next-line
        $this->getEntityManager()->persist($entity);
    }

    public function flush():void
    {
        #@phpstan-ignore-next-line
        $this->getEntityManager()->flush();
    }
}
