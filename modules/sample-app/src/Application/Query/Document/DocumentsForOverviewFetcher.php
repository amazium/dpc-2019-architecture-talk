<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Query\QueryFetcher;

interface DocumentsForOverviewFetcher extends QueryFetcher
{
    /**
     * @param DocumentsForOverview $documentsForOverview
     * @param Context $context
     * @return mixed
     */
    public function fetch(DocumentsForOverview $documentsForOverview, Context $context);
}
