<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class AddressesForIdentity extends AddressesForOverview
{
    /**
     * AddressesForIdentity constructor.
     * @param IdentityId $identityId
     * @param AddressType|null $addressType
     * @param string|null $country
     * @param string|null $zipcode
     * @param AddressState|null $state
     */
    public function __construct(
        IdentityId $identityId,
        ?AddressType $addressType = null,
        ?string $country = null,
        ?string $zipcode = null,
        ?AddressState $state = null
    ) {
        parent::__construct($addressType, $country, $zipcode, $state, $identityId);
    }
}
