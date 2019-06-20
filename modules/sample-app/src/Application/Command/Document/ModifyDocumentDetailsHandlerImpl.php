<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Context\Context;

class ModifyDocumentDetailsHandlerImpl extends AbstractDocumentHandler implements ModifyDocumentDetailsHandler
{
    /**
     * @param ModifyDocumentDetails $modifyDocumentDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyDocumentDetails $modifyDocumentDetails, Context $context): array
    {
        $document = $this->documents->findById($modifyDocumentDetails->getDocumentId());
        $document->modifyDetails(
            $modifyDocumentDetails->getDocumentType(),
            $modifyDocumentDetails->getDocumentIdentifier(),
            $modifyDocumentDetails->getValidFrom(),
            $modifyDocumentDetails->getValidUntil(),
            $modifyDocumentDetails->getExtraInfo()
        );
        $this->documents->save($document);
        return [
            'document_id' => $modifyDocumentDetails->getDocumentId()->scalar(),
        ];
    }
}
