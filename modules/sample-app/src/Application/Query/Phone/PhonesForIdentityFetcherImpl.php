<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Context\Context;

class PhonesForIdentityFetcherImpl extends AbstractPhoneFetcher implements PhonesForIdentityFetcher
{
    /**
     * @param PhonesForIdentity $phonesForIdentity
     * @param Context $context
     * @return array|mixed
     */
    public function fetch(PhonesForIdentity $phonesForIdentity, Context $context)
    {
        return $this->phones->fetchAll(
            $phonesForIdentity->getProvider(),
            $phonesForIdentity->getState(),
            $phonesForIdentity->getIdentityId()
        );
    }
}
