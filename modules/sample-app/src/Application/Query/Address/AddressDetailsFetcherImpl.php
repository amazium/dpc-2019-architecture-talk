<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Context\Context;

class AddressDetailsFetcherImpl extends AbstractAddressFetcher implements AddressDetailsFetcher
{
    /**
     * @param AddressDetails $addressDetails
     * @param Context $context
     * @return mixed|void
     */
    public function fetch(AddressDetails $addressDetails, Context $context)
    {
        return $this->addresses->fetchById($addressDetails->getAddressId());
    }
}
