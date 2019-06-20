<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Context\Context;

class PhoneDetailsFetcherImpl extends AbstractPhoneFetcher implements PhoneDetailsFetcher
{
    /**
     * @param PhoneDetails $phoneDetails
     * @param Context $context
     * @return \Amazium\SampleApp\Domain\Aggregate\Phone|mixed|null
     */
    public function fetch(PhoneDetails $phoneDetails, Context $context)
    {
        return $this->phones->fetchById($phoneDetails->getPhoneId());
    }
}
