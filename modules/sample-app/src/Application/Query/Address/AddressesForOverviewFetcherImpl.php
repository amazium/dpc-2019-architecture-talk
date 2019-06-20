<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Context\Context;

class AddressesForOverviewFetcherImpl extends AbstractAddressFetcher implements AddressesForOverviewFetcher
{
    /**
     * @param AddressesForOverview $addressDetails
     * @param Context $context
     * @return mixed|void
     */
    public function fetch(AddressesForOverview $addressDetails, Context $context)
    {
        return $this->addresses->fetchAll(
            $addressDetails->getAddressType(),
            $addressDetails->getCountry(),
            $addressDetails->getZipcode(),
            $addressDetails->getState(),
            $addressDetails->getIdentityId()
        );
    }
}
