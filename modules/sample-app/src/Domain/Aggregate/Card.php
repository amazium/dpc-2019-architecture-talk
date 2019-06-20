<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\Aggregate;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Domain\Aggregate\AggregateRoot;
use Amazium\Kernel\Domain\ValueObject\DateTime\Date;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;
use Amazium\SampleApp\Domain\ValueObject\CardId;
use Amazium\SampleApp\Domain\ValueObject\CardState;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class Card implements AggregateRoot
{
    /**
     * @var CardId
     */
    private $cardId;

    /**
     * @var IdentityId
     */
    private $identityId;

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
     * @var DocumentId|null
     */
    private $frontDocumentId;

    /**
     * @var DocumentId|null
     */
    private $backDocumentId;

    /**
     * @var BankAccountId|null
     */
    private $bankAccountId;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * @var CardState
     */
    private $state;

    /**
     * @var CardId|null
     */
    private $internalId;

    /**
     * Card constructor.
     * @param CardId $cardId
     * @param IdentityId $identityId
     * @param string $issuer
     * @param CardType $cardType
     * @param CardState $state
     * @param string|null $cardNumber
     * @param string|null $nameOnCard
     * @param Date|null $validThru
     * @param Date|null $validFrom
     * @param string|null $cvvCode
     * @param DocumentId|null $frontDocumentId
     * @param DocumentId|null $backDocumentId
     * @param BankAccountId|null $bankAccountId
     * @param array $extraInfo
     * @param CardId|null $internalId
     */
    public function __construct(
        CardId $cardId,
        IdentityId $identityId,
        string $issuer,
        CardType $cardType,
        CardState $state,
        ?string $cardNumber = null,
        ?string $nameOnCard = null,
        ?Date $validThru = null,
        ?Date $validFrom = null,
        ?string $cvvCode = null,
        ?DocumentId $frontDocumentId = null,
        ?DocumentId $backDocumentId = null,
        ?BankAccountId $bankAccountId = null,
        array $extraInfo = [],
        ?CardId $internalId = null
    ) {
        $this->cardId = $cardId;
        $this->identityId = $identityId;
        $this->issuer = $issuer;
        $this->cardType = $cardType;
        $this->state = $state;
        $this->cardNumber = $cardNumber;
        $this->nameOnCard = $nameOnCard;
        $this->validThru = $validThru;
        $this->validFrom = $validFrom;
        $this->cvvCode = $cvvCode;
        $this->frontDocumentId = $frontDocumentId;
        $this->backDocumentId = $backDocumentId;
        $this->bankAccountId = $bankAccountId;
        $this->extraInfo = $extraInfo;
        $this->internalId = $internalId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [
            'card_id' => $this->getCardId()->scalar(),
            'identity_id' => $this->getIdentityId()->scalar(),
            'issuer' => $this->getIssuer(),
            'card_type' => $this->getCardType()->scalar(),
            'card_number' => $this->getCardNumber(),
            'name_on_card' => $this->getNameOnCard(),
            'valid_thru' => $this->getValidThru() ? $this->getValidThru()->scalar() : null,
            'valid_from' => $this->getValidFrom() ? $this->getValidFrom()->scalar() : null,
            'cvv_code' => $this->getCvvCode(),
            'front_document_id' => $this->getFrontDocumentId() ? $this->getFrontDocumentId()->scalar() : null,
            'back_document_id' => $this->getBackDocumentId() ? $this->getBackDocumentId()->scalar() : null,
            'bank_account_id' => $this->getBankAccountId() ? $this->getBankAccountId()->scalar() : null,
            'extra_info' => $this->getExtraInfo(),
            'state' => $this->getState()->scalar(),
        ];
        if (empty($options[Extractable::EXTOPT_INCLUDE_IDENTIFIER])) {
            unset($return['internal_id']);
        }
        return $return;
    }

    /**
     * @param array $payload
     * @return AggregateRoot|Card
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            CardId::fromValue($payload['card_id'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null),
            $payload['issuer'] ?? null,
            CardType::fromValue($payload['card_type'] ?? null),
            CardState::fromValue($payload['state'] ?? null),
            $payload['card_number'] ?? null,
            $payload['name_on_card'] ?? null,
            Date::fromValue($payload['valid_from'] ?? null),
            Date::fromValue($payload['valid_thru'] ?? null),
            $payload['cvv_code'] ?? null,
            Document::fromValue($payload['front_document_id'] ?? null),
            Document::fromValue($payload['back_document_id'] ?? null),
            BankAccount::fromValue($payload['bank_account_id'] ?? null),
            $payload['extra_info'] ?? [],
            CardId::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @return CardId
     */
    public function getCardId(): CardId
    {
        return $this->cardId;
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return string|null
     */
    public function getIssuer(): ?string
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
     * @return string|null
     */
    public function getCvvCode(): ?string
    {
        return $this->cvvCode;
    }

    /**
     * @return DocumentId|null
     */
    public function getFrontDocumentId(): ?DocumentId
    {
        return $this->frontDocumentId;
    }

    /**
     * @return DocumentId|null
     */
    public function getBackDocumentId(): ?DocumentId
    {
        return $this->backDocumentId;
    }

    /**
     * @return BankAccountId|null
     */
    public function getBankAccountId(): ?BankAccountId
    {
        return $this->bankAccountId;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }

    /**
     * @return CardState
     */
    public function getState(): CardState
    {
        return $this->state;
    }

    /**
     * @return CardId|null
     */
    public function getInternalId(): ?CardId
    {
        return $this->internalId;
    }

    /**
     * @param CardId $cardId
     * @param IdentityId $identityId
     * @param string $issuer
     * @param CardType $cardType
     * @param string|null $cardNumber
     * @param string|null $nameOnCard
     * @param Date|null $validThru
     * @param Date|null $validFrom
     * @param string|null $cvvCode
     * @param BankAccountId|null $bankAccountId
     * @param array $extraInfo
     * @return Card
     * @throws \Exception
     */
    public static function request(
        CardId $cardId,
        IdentityId $identityId,
        string $issuer,
        CardType $cardType,
        ?string $cardNumber = null,
        ?string $nameOnCard = null,
        ?Date $validThru = null,
        ?Date $validFrom = null,
        ?string $cvvCode = null,
        ?BankAccountId $bankAccountId = null,
        array $extraInfo = []
    ): Card {
        return new static(
            $cardId,
            $identityId,
            $issuer,
            $cardType,
            CardState::fromValue(CardState::STATE_REQUESTED),
            $cardNumber,
            $nameOnCard,
            $validThru,
            $validFrom,
            $cvvCode,
            null,
            null,
            $bankAccountId,
            $extraInfo
        );
    }

    /**
     * @throws \Exception
     */
    public function activate(): void
    {
        $this->state = CardState::fromValue(CardState::STATE_ACTIVE);
    }

    /**
     * @throws \Exception
     */
    public function abandon(): void
    {
        $this->state = CardState::fromValue(CardState::STATE_ABANDONED);
    }

    /**
     * @param string $issuer
     * @param CardType $cardType
     * @param string|null $cardNumber
     * @param string|null $nameOnCard
     * @param Date|null $validThru
     * @param Date|null $validFrom
     * @param string|null $cvvCode
     */
    public function modifyDetails(
        string $issuer,
        CardType $cardType,
        ?string $cardNumber = null,
        ?string $nameOnCard = null,
        ?Date $validThru = null,
        ?Date $validFrom = null,
        ?string $cvvCode = null
    ): void {
        $this->issuer = $issuer;
        $this->cardType = $cardType;
        $this->cardNumber = $cardNumber;
        $this->nameOnCard = $nameOnCard;
        $this->validThru = $validThru;
        $this->validFrom = $validFrom;
        $this->cvvCode = $cvvCode;
    }
}
