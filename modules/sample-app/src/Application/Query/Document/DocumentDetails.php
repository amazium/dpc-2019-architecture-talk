<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;

class DocumentDetails implements Query
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * DocumentDetails constructor.
     * @param DocumentId $documentId
     */
    public function __construct(DocumentId $documentId)
    {
        $this->documentId = $documentId;
    }

    /**
     * @param array $payload
     * @return Query|DocumentDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            DocumentId::fromValue($payload['document_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'document_id' => $this->getDocumentId()->scalar()
        ];
    }

    /**
     * @return DocumentId
     */
    public function getDocumentId(): DocumentId
    {
        return $this->documentId;
    }
}
