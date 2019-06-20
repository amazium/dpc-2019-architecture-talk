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

class ReplaceDocument implements Command
{
    /**
     * @var DocumentId
     */
    private $documentId;

    /**
     * @var string
     */
    private $originalFileName;

    /**
     * @var string
     */
    private $uploadedFilePath;

    /**
     * ReplaceDocument constructor.
     * @param DocumentId $documentId
     * @param string $originalFileName
     * @param string $uploadedFilePath
     */
    public function __construct(
        DocumentId $documentId,
        string $originalFileName,
        string $uploadedFilePath
    ) {
        $this->documentId = $documentId;
        $this->originalFileName = $originalFileName;
        $this->uploadedFilePath = $uploadedFilePath;
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
            $payload['original_file_name'] ?? null,
            $payload['uploaded_file_path'] ?? null
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
            'original_file_name' => $this->getOriginalFileName(),
            'uploaded_file_path' => $this->getUploadedFilePath(),
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
}
