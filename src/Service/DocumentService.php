<?php
namespace App\Service;

use App\Entity\Document;
use App\Entity\Enum\DocumentType;
use App\Exception\Document\DocumentNotFoundException;
use App\Repository\DocumentRepository;
use App\Service\Utils\AuditService;
use App\Service\Utils\DocumentStorageResolver;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mime\MimeTypes;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use CoopTilleuls\UrlSignerBundle\UrlSigner\UrlSignerInterface;

class DocumentService
{
    public function __construct(
        private readonly DocumentStorageResolver $storageResolver,
        private readonly AuditService $audit,
        private readonly DocumentRepository $documentRepository,
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly UrlSignerInterface $urlSigner,
    ) {
    }

    /**
     * Writes the uploaded file to the storage of its type, and builds its document,
     * persisted but not flushed.
     */
    public function store(UploadedFile $file, DocumentType $type): Document
    {
        $mimeType = $file->getClientMimeType();
        $extension = MimeTypes::getDefault()->getExtensions($mimeType)[0];

        $document = (new Document())
            ->setType($type)
            ->setOriginalName(mb_substr($file->getClientOriginalName(), 0, 255))
            ->setSize($file->getSize())
            ->setMimeType($mimeType);

        $id = $document->getId();
        $document->setStorageKey(sprintf('%s.%s', $id, $extension));

        $stream = fopen($file->getPathname(), 'r');
        $this
            ->storageResolver
            ->resolve($type)
            ->writeStream($document->getStorageKey(), $stream);

        fclose($stream);

        $this->audit->stampCreation($document);
        $this->documentRepository->persist($document);

        return $document;
    }

    /**
     * Marks this document as deleted. Its file stays on the storage.
     */
    public function softDelete(Document $document): void
    {
        $this->audit->markDeleted($document);
    }

    /**
     * Returns the document carrying this identifier.
     *
     * @throws DocumentNotFoundException when no live document carries this identifier
     */
    public function findOneById(Uuid $id): Document
    {
        $document = $this->documentRepository->find($id);

        if (null === $document) {
            throw new DocumentNotFoundException();
        }

        return $document;
    }

    /**
     * Opens a read stream on the stored file of this document.
     *
     * @return resource
     *
     * @throws DocumentNotFoundException when the file is missing from its storage
     */
    public function openStream(Document $document)
    {
        $storage = $this->storageResolver->resolve($document->getType());

        if (false === $storage->fileExists($document->getStorageKey())) {
            throw new DocumentNotFoundException();
        }
        return $storage->readStream($document->getStorageKey());
    }

    /**
     * Builds the absolute, signed and expiring download URL of this document.
     */
    public function toSignedUrl(Document $document): string
    {
        $url = $this->urlGenerator->generate(
            'document_download',
            ['id' => $document->getId()],
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        return $this->urlSigner->sign($url);
    }


}
