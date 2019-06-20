<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Context\Context;

class DocumentsForOverviewFetcherImpl extends AbstractDocumentFetcher implements DocumentsForOverviewFetcher
{
    /**
     * @param DocumentsForOverview $documentsForOverview
     * @param Context $context
     * @return mixed
     */
    public function fetch(DocumentsForOverview $documentsForOverview, Context $context)
    {
        return $this->documents->fetchAll(
            $documentsForOverview->getDocumentType(),
            $documentsForOverview->getIdentityId()
        );
    }
}
