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

class ModifyDocumentDetails implements Command
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * @var DocumentType
     */
    private $documentType;

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
     * ModifyDocumentDetails constructor.
     * @param DocumentId $documentId
     * @param DocumentType $documentType
     * @param string|null $documentIdentifier
     * @param Date|null $validFrom
     * @param Date|null $validUntil
     * @param array $extraInfo
     */
    public function __construct(
        DocumentId $documentId,
        DocumentType $documentType,
        ?string $documentIdentifier,
        ?Date $validFrom = null,
        ?Date $validUntil = null,
        array $extraInfo = []
    ) {
        $this->documentId = $documentId;
        $this->documentType = $documentType;
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
            DocumentId::fromValue($payload['document_id'] ?? null),
            DocumentType::fromValue($payload['document_type'] ?? null),
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
            'document_type' => $this->getDocumentType()->scalar(),
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
     * @return DocumentType
     */
    public function getDocumentType(): DocumentType
    {
        return $this->documentType;
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
