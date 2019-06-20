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

interface IdentityDetailsFetcher extends QueryFetcher
{
    /**
     * @param IdentityDetails $identityDetails
     * @param Context $context
     * @return mixed
     */
    public function fetch(IdentityDetails $identityDetails, Context $context);
}
