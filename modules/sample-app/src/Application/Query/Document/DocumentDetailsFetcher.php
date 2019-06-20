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

interface DocumentDetailsFetcher extends QueryFetcher
{
    /**
     * @param DocumentDetails $documentDetails
     * @param Context $context
     * @return mixed
     */
    public function fetch(DocumentDetails $documentDetails, Context $context);
}
