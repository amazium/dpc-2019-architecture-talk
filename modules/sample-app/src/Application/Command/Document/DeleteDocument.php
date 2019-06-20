<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Command\Command;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;

class DeleteDocument implements Command
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * DeleteDocument constructor.
     * @param DocumentId $documentId
     */
    public function __construct(
        DocumentId $documentId
    ) {
        $this->documentId = $documentId;
    }

    /**
     * @param array $payload
     * @return Command|UploadDocument
     * @throws \Exception
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
            'document_id' => $this->getDocumentId()->scalar(),
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
