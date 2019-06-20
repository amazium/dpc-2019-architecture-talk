<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Repository\Document as DocumentRepository;
use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\ValueObject\FileType;

class ReplaceDocumentHandlerImpl extends AbstractDocumentHandler implements ReplaceDocumentHandler
{
    /**
     * @param ReplaceDocument $replaceDocument
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(ReplaceDocument $replaceDocument, Context $context): array
    {
        // Calculate document information
        $fileType = FileType::fromValue(
            substr(
                $replaceDocument->getOriginalFileName(),
                strrpos($replaceDocument->getOriginalFileName(), '.') + 1
            )
        );
        $content = file_get_contents($replaceDocument->getUploadedFilePath());

        // Replace in document
        $document = $this->documents->findById($replaceDocument->getDocumentId());
        $document->replace($fileType, $content);
        $this->documents->save($document);
        return [
            'document_id' => $document->getDocumentId()->scalar(),
        ];
    }
}
