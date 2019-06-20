<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Context\Context;

class DocumentDetailsFetcherImpl extends AbstractDocumentFetcher implements DocumentDetailsFetcher
{
    /**
     * @param DocumentDetails $documentDetails
     * @param Context $context
     * @return \Amazium\SampleApp\Domain\Aggregate\Document|mixed|null
     */
    public function fetch(DocumentDetails $documentDetails, Context $context)
    {
        return $this->documents->fetchById($documentDetails->getDocumentId());
    }
}
