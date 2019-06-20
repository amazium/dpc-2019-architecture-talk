<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class DocumentsForOverview implements Query
{
    /**
     * @var IdentityId|null
     */
    private $identityId;

    /**
     * @var DocumentType|null
     */
    private $documentType;

    /**
     * AddressesForOverview constructor.
     * @param DocumentType|null $documentType
     * @param IdentityId|null $identityId
     */
    public function __construct(
        ?DocumentType $documentType = null,
        ?IdentityId $identityId = null
    ) {
        $this->documentType = $documentType;
        $this->identityId = $identityId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'document_type' => $this->getDocumentType() ? $this->getDocumentType()->scalar() : null,
            'identity_id' => $this->getIdentityId() ? $this->getIdentityId()->scalar() : null,
        ];
    }

    /**
     * @param array $payload
     * @return Query|AddressesForOverview
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            DocumentType::fromValue($payload['document_type'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null)
        );
    }

    /**
     * @return IdentityId|null
     */
    public function getIdentityId(): ?IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return DocumentType|null
     */
    public function getDocumentType(): ?DocumentType
    {
        return $this->documentType;
    }
}
