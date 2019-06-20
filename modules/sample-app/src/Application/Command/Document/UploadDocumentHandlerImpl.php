<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Aggregate\Document;
use Amazium\SampleApp\Domain\Repository\Document as DocumentRepository;
use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\ValueObject\FileType;

class UploadDocumentHandlerImpl extends AbstractDocumentHandler implements UploadDocumentHandler
{
    /**
     * @param UploadDocument $uploadDocument
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(UploadDocument $uploadDocument, Context $context): array
    {
        // Calculate document information
        $fileType = FileType::fromValue(
            substr(
                $uploadDocument->getOriginalFileName(),
                strrpos($uploadDocument->getOriginalFileName(), '.') + 1
            )
        );
        $content = file_get_contents($uploadDocument->getUploadedFilePath());

        // Create new document and save it
        $document = Document::create(
            $uploadDocument->getDocumentId(),
            $uploadDocument->getIdentityId(),
            $uploadDocument->getDocumentType(),
            $fileType,
            $content,
            $uploadDocument->getDocumentIdentifier(),
            $uploadDocument->getValidFrom(),
            $uploadDocument->getValidUntil(),
            $uploadDocument->getExtraInfo()
        );
        $this->documents->save($document);
        return [
            'document_id' => $uploadDocument->getDocumentId()->scalar(),
        ];
    }
}
