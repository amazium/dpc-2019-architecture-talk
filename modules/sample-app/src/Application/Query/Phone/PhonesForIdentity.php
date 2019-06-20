<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\ValueObject\PhoneState;

class PhonesForIdentity extends PhonesForOverview
{
    /**
     * PhonesForIdentity constructor.
     * @param IdentityId $identityId
     * @param string|null $provider
     * @param PhoneState|null $state
     */
    public function __construct(
        IdentityId $identityId,
        ?string $provider = null,
        ?PhoneState $state = null
    ) {
        parent::__construct($provider, $state, $identityId);
    }
}
