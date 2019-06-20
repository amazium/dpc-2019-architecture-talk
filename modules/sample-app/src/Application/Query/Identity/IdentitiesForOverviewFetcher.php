<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Identity;

use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Query\QueryFetcher;

interface IdentitiesForOverviewFetcher extends QueryFetcher
{
    /**
     * @param IdentitiesForOverview $identitiesForOverview
     * @param Context $context
     * @return mixed
     */
    public function fetch(IdentitiesForOverview $identitiesForOverview, Context $context);
}
