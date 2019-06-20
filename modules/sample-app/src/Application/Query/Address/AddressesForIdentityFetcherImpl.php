<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Context\Context;

class AddressesForIdentityFetcherImpl extends AbstractAddressFetcher implements AddressesForIdentityFetcher
{
    /**
     * @param AddressesForIdentity $addressesForIdentity
     * @param Context $context
     * @return mixed|void
     */
    public function fetch(AddressesForIdentity $addressesForIdentity, Context $context)
    {
        return $this->addresses->fetchAll(
            $addressesForIdentity->getAddressType(),
            $addressesForIdentity->getCountry(),
            $addressesForIdentity->getZipcode(),
            $addressesForIdentity->getState(),
            $addressesForIdentity->getIdentityId()
        );
    }
}
