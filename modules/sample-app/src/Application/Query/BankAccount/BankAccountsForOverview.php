<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\BankAccountState;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class BankAccountsForOverview implements Query
{
    /**
     * @var IdentityId|null
     */
    private $identityId;

    /**
     * @var BankAccountState|null
     */
    private $state;

    /**
     * @var string|null
     */
    private $bankName;

    /**
     * BankAccountsForOverview constructor.
     * @param string|null $bankName
     * @param BankAccountState|null $state
     * @param IdentityId|null $identityId
     */
    public function __construct(
        ?string $bankName = null,
        ?BankAccountState $state = null,
        ?IdentityId $identityId = null
    ) {
        $this->bankName = $bankName;
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
            'bank_name' => $this->getBankName(),
            'state' => $this->getState() ? $this->getState()->scalar() : null,
            'identity_id' => $this->getIdentityId() ? $this->getIdentityId()->scalar() : null,
        ];
    }

    /**
     * @param array $payload
     * @return Query|BankAccountsForOverview
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            !empty($payload['bank_name']) ? $payload['bank_name'] : null,
            !empty($payload['state']) ? BankAccountState::fromValue($payload['state']) : null,
            !empty($payload['identity_id']) ? IdentityId::fromValue($payload['identity_id']) : null
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
     * @return BankAccountState|null
     */
    public function getState(): ?BankAccountState
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getBankName(): ?string
    {
        return $this->bankName;
    }
}
