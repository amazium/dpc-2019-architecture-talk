<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Command\Command;
use Amazium\SampleApp\Domain\ValueObject\AddressId;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class RequestBankAccount implements Command
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
     * RequestBankAccount constructor.
     * @param IdentityId $identityId
     * @param string|null $accountNumber
     * @param string|null $nameOnAccount
     * @param string|null $bankName
     * @param string|null $bankAddressLine1
     * @param string|null $bankAddressLine2
     * @param string|null $bankAddressLine3
     * @param AddressId|null $cardAddressId
     * @param array $extraInfo
     * @throws \Exception
     */
    public function __construct(
        IdentityId $identityId,
        ?string $accountNumber,
        ?string $nameOnAccount = null,
        ?string $bankName = null,
        ?string $bankAddressLine1 = null,
        ?string $bankAddressLine2 = null,
        ?string $bankAddressLine3 = null,
        ?AddressId $cardAddressId = null,
        array $extraInfo = []
    ) {
        $this->bankAccountId = BankAccountId::generate();
        $this->identityId = $identityId;
        $this->accountNumber = $accountNumber;
        $this->nameOnAccount = $nameOnAccount;
        $this->bankName = $bankName;
        $this->bankAddressLine1 = $bankAddressLine1;
        $this->bankAddressLine2 = $bankAddressLine2;
        $this->bankAddressLine3 = $bankAddressLine3;
        $this->cardAddressId = $cardAddressId;
        $this->extraInfo = $extraInfo;
    }

    /**
     * @param array $payload
     * @return Command|RequestBankAccount
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            IdentityId::fromValue($payload['identity_id'] ?? null),
            $payload['account_number'] ?? null,
            $payload['name_on_account'] ?? null,
            $payload['bank_name'] ?? null,
            $payload['bank_address_line_1'] ?? null,
            $payload['bank_address_line_2'] ?? null,
            $payload['bank_address_line_3'] ?? null,
            AddressId::fromValue($payload['card_address_id'] ?? null),
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
        ];
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
}
