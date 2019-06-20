<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\Aggregate;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Domain\Aggregate\AggregateRoot;
use Amazium\Kernel\Domain\ValueObject\DateTime\Date;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;
use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\FileType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class Document implements AggregateRoot
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * @var IdentityId
     */
    private $identityId;

    /**
     * @var DocumentType
     */
    private $documentType;

    /**
     * @var FileType
     */
    private $fileType;

    /**
     * @var string
     */
    private $document;

    /**
     * @var string|null
     */
    private $documentIdentifier;

    /**
     * @var Date|null
     */
    private $validFrom;

    /**
     * @var Date|null
     */
    private $validUntil;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * @var DocumentId|null
     */
    private $internalId;

    /**
     * Document constructor.
     * @param DocumentId $documentId
     * @param IdentityId $identityId
     * @param DocumentType $documentType
     * @param FileType $fileType
     * @param string $document
     * @param string|null $documentIdentifier
     * @param Date|null $validFrom
     * @param Date|null $validUntil
     * @param array $extraInfo
     * @param DocumentId|null $internalId
     */
    public function __construct(
        DocumentId $documentId,
        IdentityId $identityId,
        DocumentType $documentType,
        FileType $fileType,
        string $document,
        ?string $documentIdentifier,
        ?Date $validFrom = null,
        ?Date $validUntil = null,
        array $extraInfo = [],
        ?DocumentId $internalId = null
    ) {
        $this->documentId = $documentId;
        $this->identityId = $identityId;
        $this->documentType = $documentType;
        $this->fileType = $fileType;
        $this->document = $document;
        $this->documentIdentifier = $documentIdentifier;
        $this->validFrom = $validFrom;
        $this->validUntil = $validUntil;
        $this->extraInfo = $extraInfo;
        $this->internalId = $internalId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [
            'document_id' => $this->getDocumentId()->scalar(),
            'identity_id' => $this->getIdentityId()->scalar(),
            'document_type' => $this->getDocumentType()->scalar(),
            'file_type' => $this->getFileType()->scalar(),
            'document' => $this->getDocument(),
            'document_identifier' => $this->getDocumentIdentifier(),
            'valid_from' => $this->getValidFrom() ? $this->getValidFrom()->scalar() : null,
            'valid_until' => $this->getValidUntil() ? $this->getValidUntil()->scalar() : null,
            'extra_info' => $this->getExtraInfo(),
        ];
        if (empty($options[Extractable::EXTOPT_INCLUDE_IDENTIFIER])) {
            unset($return['internal_id']);
        }
        return $return;
    }

    /**
     * @param array $payload
     * @return AggregateRoot|Document
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            DocumentId::fromValue($payload['document_id'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null),
            DocumentType::fromValue($payload['document_type'] ?? null),
            FileType::fromValue($payload['file_type'] ?? null),
            $payload['document'] ?? null,
            $payload['document_identifier'] ?? null,
            Date::fromValue($payload['valid_from'] ?? null),
            Date::fromValue($payload['valid_until'] ?? null),
            $payload['extra_info'] ?? [],
            DocumentId::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @return DocumentId
     */
    public function getDocumentId(): DocumentId
    {
        return $this->documentId;
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return DocumentType
     */
    public function getDocumentType(): DocumentType
    {
        return $this->documentType;
    }

    /**
     * @return FileType
     */
    public function getFileType(): FileType
    {
        return $this->fileType;
    }

    /**
     * @return string
     */
    public function getDocument(): string
    {
        return $this->document;
    }

    /**
     * @return string
     */
    public function getDocumentIdentifier(): ?string
    {
        return $this->documentIdentifier;
    }

    /**
     * @return Date|null
     */
    public function getValidFrom(): ?Date
    {
        return $this->validFrom;
    }

    /**
     * @return Date|null
     */
    public function getValidUntil(): ?Date
    {
        return $this->validUntil;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }

    /**
     * @return DocumentId|null
     */
    public function getInternalId(): ?DocumentId
    {
        return $this->internalId;
    }

    /**
     * @param DocumentId $documentId
     * @param IdentityId $identityId
     * @param DocumentType $documentType
     * @param FileType $fileType
     * @param string $document
     * @param string|null $documentIdentifier
     * @param Date|null $validFrom
     * @param Date|null $validUntil
     * @param array $extraInfo
     * @return Document
     */
    public static function create(
        DocumentId $documentId,
        IdentityId $identityId,
        DocumentType $documentType,
        FileType $fileType,
        string $document,
        ?string $documentIdentifier,
        ?Date $validFrom = null,
        ?Date $validUntil = null,
        array $extraInfo = []
    ): Document {
        return new static(
            $documentId,
            $identityId,
            $documentType,
            $fileType,
            $document,
            $documentIdentifier,
            $validFrom,
            $validUntil,
            $extraInfo
        );
    }

    /**
     * @param FileType $fileType
     * @param string $document
     */
    public function replace(FileType $fileType, string $document)
    {
        $this->fileType = $fileType;
        $this->document = $document;
    }

    /**
     * @param DocumentType $documentType
     * @param string|null $documentIdentifier
     * @param Date|null $validFrom
     * @param Date|null $validUntil
     * @param array $extraInfo
     */
    public function modifyDetails(
        DocumentType $documentType,
        ?string $documentIdentifier,
        ?Date $validFrom = null,
        ?Date $validUntil = null,
        array $extraInfo = []
    ): void {
        $this->documentType = $documentType;
        $this->documentIdentifier = $documentIdentifier;
        $this->validFrom = $validFrom;
        $this->validUntil = $validUntil;
        $this->extraInfo = $extraInfo;
    }
}
