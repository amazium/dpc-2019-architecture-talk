<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Query\QueryFetcher;

interface CardDetailsFetcher extends QueryFetcher
{
    /**
     * @param CardDetails $cardDetails
     * @param Context $context
     * @return mixed
     */
    public function fetch(CardDetails $cardDetails, Context $context);
}
