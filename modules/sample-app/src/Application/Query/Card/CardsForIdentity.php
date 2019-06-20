<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\SampleApp\Domain\ValueObject\CardState;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class CardsForIdentity extends CardsForOverview
{
    /**
     * CardsForIdentity constructor.
     * @param IdentityId $identityId
     * @param CardType|null $cardType
     * @param string|null $issuer
     * @param CardState|null $state
     */
    public function __construct(
        IdentityId $identityId,
        ?CardType $cardType = null,
        ?string $issuer = null,
        ?CardState $state = null
    ) {
        parent::__construct($cardType, $issuer, $state, $identityId);
    }
}
