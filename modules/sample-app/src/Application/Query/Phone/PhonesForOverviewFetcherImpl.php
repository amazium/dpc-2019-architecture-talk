<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Context\Context;

class PhonesForOverviewFetcherImpl extends AbstractPhoneFetcher implements PhonesForOverviewFetcher
{
    /**
     * @param PhonesForOverview $phonesForOverview
     * @param Context $context
     * @return array|mixed
     */
    public function fetch(PhonesForOverview $phonesForOverview, Context $context)
    {
        return $this->phones->fetchAll(
            $phonesForOverview->getProvider(),
            $phonesForOverview->getState(),
            $phonesForOverview->getIdentityId()
        );
    }
}
