<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Identity;

use Amazium\Kernel\Application\Context\Context;

class IdentityDetailsFetcherImpl extends AbstractIdentitiesFetcher implements IdentityDetailsFetcher
{
    /**
     * @param IdentityDetails $identityDetails
     * @param Context $context
     * @return \Amazium\SampleApp\Domain\Aggregate\Identity|mixed|null
     */
    public function fetch(IdentityDetails $identityDetails, Context $context)
    {
        return $this->identities->fetchById($identityDetails->getIdentityId());
    }
}
