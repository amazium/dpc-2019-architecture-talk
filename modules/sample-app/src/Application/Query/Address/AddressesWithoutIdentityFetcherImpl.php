<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Context\Context;

class AddressesWithoutIdentityFetcherImpl extends AbstractAddressFetcher implements AddressesWithoutIdentityFetcher
{
    /**
     * @param AddressesWithoutIdentity $addressesWithoutIdentity
     * @param Context $context
     * @return array|mixed
     */
    public function fetch(AddressesWithoutIdentity $addressesWithoutIdentity, Context $context)
    {
        return $this->addresses->fetchAllWithoutIdentity(
            $addressesWithoutIdentity->getAddressType(),
            $addressesWithoutIdentity->getCountry(),
            $addressesWithoutIdentity->getZipcode(),
            $addressesWithoutIdentity->getState()
        );
    }
}
