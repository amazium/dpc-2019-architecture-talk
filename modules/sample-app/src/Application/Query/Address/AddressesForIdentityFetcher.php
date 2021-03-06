<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Query\QueryFetcher;

interface AddressesForIdentityFetcher extends QueryFetcher
{
    /**
     * @param AddressesForIdentity $addressesForIdentity
     * @param Context $context
     * @return mixed
     */
    public function fetch(AddressesForIdentity $addressesForIdentity, Context $context);
}
