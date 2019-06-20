<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Context\Context;

class DeleteDocumentHandlerImpl extends AbstractDocumentHandler implements DeleteDocumentHandler
{
    /**
     * @param DeleteDocument $deleteDocument
     * @param Context $context
     * @return array
     */
    public function handle(DeleteDocument $deleteDocument, Context $context): array
    {
        $this->documents->deletById($deleteDocument->getDocumentId());
        return [
            'document_id' => $deleteDocument->getDocumentId()->scalar(),
        ];
    }
}
