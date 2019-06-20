<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Command\Command;
use Amazium\Kernel\Domain\ValueObject\DateTime\Date;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;
use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class UploadDocument implements Command
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
     * @var string
     */
    private $originalFileName;

    /**
     * @var string
     */
    private $uploadedFilePath;

    /**
     * @var string
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
     * UploadDocument constructor.
     * @param IdentityId $identityId
     * @param DocumentType $documentType
     * @param string $originalFileName
     * @param string $uploadedFilePath
     * @param string|null $documentIdentifier
     * @param Date|null $validFrom
     * @param Date|null $validUntil
     * @param array $extraInfo
     * @throws \Exception
     */
    public function __construct(
        IdentityId $identityId,
        DocumentType $documentType,
        string $originalFileName,
        string $uploadedFilePath,
        ?string $documentIdentifier,
        ?Date $validFrom = null,
        ?Date $validUntil = null,
        array $extraInfo = []
    ) {
        $this->documentId = DocumentId::generate();
        $this->identityId = $identityId;
        $this->documentType = $documentType;
        $this->originalFileName = $originalFileName;
        $this->uploadedFilePath = $uploadedFilePath;
        $this->documentIdentifier = $documentIdentifier;
        $this->validFrom = $validFrom;
        $this->validUntil = $validUntil;
        $this->extraInfo = $extraInfo;
    }

    /**
     * @param array $payload
     * @return Command|UploadDocument
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            IdentityId::fromValue($payload['identity_id'] ?? null),
            DocumentType::fromValue($payload['document_type'] ?? null),
            $payload['original_file_name'] ?? null,
            $payload['uploaded_file_path'] ?? null,
            $payload['document_identifier'] ?? null,
            Date::fromValue($payload['valid_from'] ?? null),
            Date::fromValue($payload['valid_until'] ?? null),
            $payload['extra_info'] ?? []
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'document_id' => $this->getDocumentId()->scalar(),
            'identity_id' => $this->getIdentityId()->scalar(),
            'document_type' => $this->getDocumentType()->scalar(),
            'original_file_name' => $this->getOriginalFileName(),
            'uploaded_file_path' => $this->getUploadedFilePath(),
            'document_identifier' => $this->getDocumentIdentifier(),
            'valid_from' => $this->getValidFrom() ? $this->getValidFrom()->scalar() : null,
            'valid_until' => $this->getValidUntil() ? $this->getValidUntil()->scalar() : null,
            'extra_info' => $this->getExtraInfo(),
        ];
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
     * @return string
     */
    public function getOriginalFileName(): string
    {
        return $this->originalFileName;
    }

    /**
     * @return string
     */
    public function getUploadedFilePath(): string
    {
        return $this->uploadedFilePath;
    }

    /**
     * @return string
     */
    public function getDocumentIdentifier(): string
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
}
