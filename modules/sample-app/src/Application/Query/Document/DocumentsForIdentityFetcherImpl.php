<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Context\Context;

class DocumentsForIdentityFetcherImpl extends AbstractDocumentFetcher implements DocumentsForIdentityFetcher
{
    /**
     * @param DocumentsForIdentity $documentDetails
     * @param Context $context
     * @return mixed|void
     */
    public function fetch(DocumentsForIdentity $documentDetails, Context $context)
    {
        return $this->documents->fetchAll(
            $documentDetails->getDocumentType(),
            $documentDetails->getIdentityId()
        );
    }
}
