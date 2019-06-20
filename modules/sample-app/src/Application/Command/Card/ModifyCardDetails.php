<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Command\Command;
use Amazium\Kernel\Domain\ValueObject\DateTime\Date;
use Amazium\SampleApp\Domain\ValueObject\CardId;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class ModifyCardDetails implements Command
{
    /**
     * @var CardId
     */
    private $cardId;

    /**
     * @var string
     */
    private $issuer;

    /**
     * @var CardType
     */
    private $cardType;

    /**
     * @var string|null
     */
    private $cardNumber;

    /**
     * @var string|null
     */
    private $nameOnCard;

    /**
     * @var Date|null
     */
    private $validThru;

    /**
     * @var Date|null
     */
    private $validFrom;

    /**
     * @var string
     */
    private $cvvCode;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * ModifyCardDetails constructor.
     * @param CardId $cardId
     * @param string $issuer
     * @param CardType $cardType
     * @param string|null $cardNumber
     * @param string|null $nameOnCard
     * @param Date|null $validThru
     * @param Date|null $validFrom
     * @param string|null $cvvCode
     * @param array $extraInfo
     */
    public function __construct(
        CardId $cardId,
        string $issuer,
        CardType $cardType,
        ?string $cardNumber = null,
        ?string $nameOnCard = null,
        ?Date $validThru = null,
        ?Date $validFrom = null,
        ?string $cvvCode = null,
        array $extraInfo = []
    ) {
        $this->cardId = $cardId;
        $this->issuer = $issuer;
        $this->cardType = $cardType;
        $this->cardNumber = $cardNumber;
        $this->nameOnCard = $nameOnCard;
        $this->validThru = $validThru;
        $this->validFrom = $validFrom;
        $this->cvvCode = $cvvCode;
        $this->extraInfo = $extraInfo;
    }

    /**
     * @param array $payload
     * @return Command|RequestCard
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            CardId::fromValue($payload['card_id'] ?? null),
            $payload['issuer'] ?? null,
            CardType::fromValue($payload['card_type'] ?? null),
            $payload['card_number'] ?? null,
            $payload['name_on_card'] ?? null,
            Date::fromValue($payload['valid_from'] ?? null),
            Date::fromValue($payload['valid_thru'] ?? null),
            $payload['cvv_code'] ?? null,
            $payload['extra_info'] ?? []
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'card_id' => $this->getCardId()->scalar(),
            'issuer' => $this->getIssuer(),
            'card_type' => $this->getCardType()->scalar(),
            'card_number' => $this->getCardNumber(),
            'name_on_card' => $this->getNameOnCard(),
            'valid_thru' => $this->getValidThru() ? $this->getValidThru()->scalar() : null,
            'valid_from' => $this->getValidFrom() ? $this->getValidFrom()->scalar() : null,
            'cvv_code' => $this->getCvvCode(),
            'extra_info' => $this->getExtraInfo(),
        ];
    }

    /**
     * @return CardId
     */
    public function getCardId(): CardId
    {
        return $this->cardId;
    }

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * @return CardType
     */
    public function getCardType(): CardType
    {
        return $this->cardType;
    }

    /**
     * @return string|null
     */
    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    /**
     * @return string|null
     */
    public function getNameOnCard(): ?string
    {
        return $this->nameOnCard;
    }

    /**
     * @return Date|null
     */
    public function getValidThru(): ?Date
    {
        return $this->validThru;
    }

    /**
     * @return Date|null
     */
    public function getValidFrom(): ?Date
    {
        return $this->validFrom;
    }

    /**
     * @return string
     */
    public function getCvvCode(): string
    {
        return $this->cvvCode;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }
}
