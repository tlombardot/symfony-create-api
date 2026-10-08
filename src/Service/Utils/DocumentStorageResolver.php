<?php

namespace App\Service\Utils;

use App\Entity\Enum\DocumentType;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireLocator;
use Symfony\Component\DependencyInjection\ServiceLocator;

class DocumentStorageResolver
{
    public function __construct(
        #[AutowireLocator([
            DocumentType::ProfilePicture->value => new Autowire(service: 'profile_pictures.storage'),
        ])]
        private readonly ServiceLocator $storage,
    ) {
    }

    /**
     * Returns the storage that holds the documents of this type.
     *
     * @throws \LogicException when no storage is configured for this type
     */
    public function resolve(DocumentType $type): FilesystemOperator
    {
        if (!$this->storage->has($type->value)) {
            throw new \LogicException('Pas de storage configué pour le type de document');
        }

        return $this->storage->get($type->value);

    }
}
