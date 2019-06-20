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
use Amazium\SampleApp\Domain\ValueObject\AddressId;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;
use Amazium\SampleApp\Domain\ValueObject\BankAccountState;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class BankAccount implements AggregateRoot
{
    /**
     * @var BankAccountId
     */
    private $bankAccountId;

    /**
     * @var IdentityId
     */
    private $identityId;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * @var BankAccountState
     */
    private $state;

    /**
     * @var string|null
     */
    private $nameOnAccount;

    /**
     * @var string|null
     */
    private $bankName;

    /**
     * @var string|null
     */
    private $bankAddressLine1;

    /**
     * @var string|null
     */
    private $bankAddressLine2;

    /**
     * @var string|null
     */
    private $bankAddressLine3;

    /**
     * @var AddressId|null
     */
    private $cardAddressId;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * @var BankAccountId|null
     */
    private $internalId;

    /**
     * BankAccount constructor.
     * @param BankAccountId $bankAccountId
     * @param IdentityId $identityId
     * @param BankAccountState $state
     * @param string|null $accountNumber
     * @param string|null $nameOnAccount
     * @param string|null $bankName
     * @param string|null $bankAddressLine1
     * @param string|null $bankAddressLine2
     * @param string|null $bankAddressLine3
     * @param AddressId|null $cardAddressId
     * @param array $extraInfo
     * @param BankAccountId|null $internalId
     */
    public function __construct(
        BankAccountId $bankAccountId,
        IdentityId $identityId,
        BankAccountState $state,
        ?string $accountNumber,
        ?string $nameOnAccount = null,
        ?string $bankName = null,
        ?string $bankAddressLine1 = null,
        ?string $bankAddressLine2 = null,
        ?string $bankAddressLine3 = null,
        ?AddressId $cardAddressId = null,
        array $extraInfo = [],
        ?BankAccountId $internalId = null
    ) {
        $this->bankAccountId = $bankAccountId;
        $this->identityId = $identityId;
        $this->state = $state;
        $this->accountNumber = $accountNumber;
        $this->nameOnAccount = $nameOnAccount;
        $this->bankName = $bankName;
        $this->bankAddressLine1 = $bankAddressLine1;
        $this->bankAddressLine2 = $bankAddressLine2;
        $this->bankAddressLine3 = $bankAddressLine3;
        $this->cardAddressId = $cardAddressId;
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
            'bank_account_id' => $this->getBankAccountId()->scalar(),
            'identity_id' => $this->getIdentityId()->scalar(),
            'card_address_id' => $this->getCardAddressId() ? $this->getCardAddressId()->scalar() : null,
            'account_number' => $this->getAccountNumber(),
            'name_on_account' => $this->getNameOnAccount(),
            'bank_name' => $this->getBankName(),
            'bank_address_line_1' => $this->getBankAddressLine1(),
            'bank_address_line_2' => $this->getBankAddressLine2(),
            'bank_address_line_3' => $this->getBankAddressLine3(),
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
     * @return AggregateRoot|BankAccount
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            BankAccountId::fromValue($payload['bank_account_id'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null),
            BankAccountState::fromValue($payload['state'] ?? null),
            $payload['account_number'] ?? null,
            $payload['name_on_account'] ?? null,
            $payload['bank_name'] ?? null,
            $payload['bank_address_line_1'] ?? null,
            $payload['bank_address_line_2'] ?? null,
            $payload['bank_address_line_3'] ?? null,
            AddressId::fromValue($payload['card_address_id'] ?? null),
            $payload['extra_info'] ?? [],
            BankAccountId::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @return BankAccountId
     */
    public function getBankAccountId(): BankAccountId
    {
        return $this->bankAccountId;
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * @return BankAccountState
     */
    public function getState(): BankAccountState
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getNameOnAccount(): ?string
    {
        return $this->nameOnAccount;
    }

    /**
     * @return string|null
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    /**
     * @return string|null
     */
    public function getBankAddressLine1(): ?string
    {
        return $this->bankAddressLine1;
    }

    /**
     * @return string|null
     */
    public function getBankAddressLine2(): ?string
    {
        return $this->bankAddressLine2;
    }

    /**
     * @return string|null
     */
    public function getBankAddressLine3(): ?string
    {
        return $this->bankAddressLine3;
    }

    /**
     * @return AddressId|null
     */
    public function getCardAddressId(): ?AddressId
    {
        return $this->cardAddressId;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }

    /**
     * @return BankAccountId|null
     */
    public function getInternalId(): ?BankAccountId
    {
        return $this->internalId;
    }

    /**
     * @param BankAccountId $bankAccountId
     * @param IdentityId $identityId
     * @param string|null $accountNumber
     * @param string|null $nameOnAccount
     * @param string|null $bankName
     * @param string|null $bankAddressLine1
     * @param string|null $bankAddressLine2
     * @param string|null $bankAddressLine3
     * @param AddressId|null $cardAddressId
     * @param array $extraInfo
     * @return BankAccount
     * @throws \Exception
     */
    public static function request(
        BankAccountId $bankAccountId,
        IdentityId $identityId,
        ?string $accountNumber,
        ?string $nameOnAccount = null,
        ?string $bankName = null,
        ?string $bankAddressLine1 = null,
        ?string $bankAddressLine2 = null,
        ?string $bankAddressLine3 = null,
        ?AddressId $cardAddressId = null,
        array $extraInfo = []
    ): BankAccount {
        return new static(
            $bankAccountId,
            $identityId,
            BankAccountState::fromValue(BankAccountState::STATE_REQUESTED),
            $accountNumber,
            $nameOnAccount,
            $bankName,
            $bankAddressLine1,
            $bankAddressLine2,
            $bankAddressLine3,
            $cardAddressId,
            $extraInfo
        );
    }

    /**
     * @throws \Exception
     */
    public function activate(): void
    {
        $this->state = BankAccountState::fromValue(BankAccountState::STATE_ACTIVE);
    }

    /**
     * @throws \Exception
     */
    public function abandon(): void
    {
        $this->state = BankAccountState::fromValue(BankAccountState::STATE_ABANDONED);
    }

    /**
     * @param string|null $accountNumber
     * @param string|null $nameOnAccount
     * @param string|null $bankName
     * @param string|null $bankAddressLine1
     * @param string|null $bankAddressLine2
     * @param string|null $bankAddressLine3
     * @param AddressId|null $cardAddressId
     * @param array $extraInfo
     */
    public function modifyDetails(
        ?string $accountNumber,
        ?string $nameOnAccount = null,
        ?string $bankName = null,
        ?string $bankAddressLine1 = null,
        ?string $bankAddressLine2 = null,
        ?string $bankAddressLine3 = null,
        ?AddressId $cardAddressId = null,
        array $extraInfo = []
    ): void {
        $this->accountNumber = $accountNumber;
        $this->nameOnAccount = $nameOnAccount;
        $this->bankName = $bankName;
        $this->bankAddressLine1 = $bankAddressLine1;
        $this->bankAddressLine2 = $bankAddressLine2;
        $this->bankAddressLine3 = $bankAddressLine3;
        $this->cardAddressId = $cardAddressId;
        $this->extraInfo = $extraInfo;
    }
}
