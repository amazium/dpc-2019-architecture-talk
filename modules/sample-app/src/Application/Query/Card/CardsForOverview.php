<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\CardState;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class CardsForOverview implements Query
{
    /**
     * @var IdentityId|null
     */
    private $identityId;

    /**
     * @var CardState|null
     */
    private $state;

    /**
     * @var CardType|null
     */
    private $cardType;

    /**
     * @var string|null
     */
    private $issuer;

    /**
     * CardsForOverview constructor.
     * @param CardType|null $cardType
     * @param string|null $issuer
     * @param CardState|null $state
     * @param IdentityId|null $identityId
     */
    public function __construct(
        ?CardType $cardType = null,
        ?string $issuer = null,
        ?CardState $state = null,
        ?IdentityId $identityId = null
    ) {
        $this->cardType = $cardType;
        $this->issuer = $issuer;
        $this->state = $state;
        $this->identityId = $identityId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'card_type' => $this->getCardType() ? $this->getCardType()->scalar() : null,
            'issuer' => $this->getIssuer(),
            'state' => $this->getState() ? $this->getState()->scalar() : null,
            'identity_id' => $this->getIdentityId() ? $this->getIdentityId()->scalar() : null,
        ];
    }

    /**
     * @param array $payload
     * @return Query|CardsForOverview
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            empty($payload['card_type']) ? null : CardType::fromValue($payload['card_type']),
            empty($payload['issuer']) ? null : $payload['issuer'],
            empty($payload['state']) ? null : CardState::fromValue($payload['state']),
            empty($payload['identity_id']) ? null : IdentityId::fromValue($payload['identity_id'])
        );
    }

    /**
     * @return IdentityId|null
     */
    public function getIdentityId(): ?IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return CardState|null
     */
    public function getState(): ?CardState
    {
        return $this->state;
    }

    /**
     * @return CardType|null
     */
    public function getCardType(): ?CardType
    {
        return $this->cardType;
    }

    /**
     * @return string|null
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }
}
