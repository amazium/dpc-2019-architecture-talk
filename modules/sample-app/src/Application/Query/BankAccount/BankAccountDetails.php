<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;

class BankAccountDetails implements Query
{
    /**
     * @var BankAccountId
     */
    private $bankAccountId;

    /**
     * BankAccountDetails constructor.
     * @param BankAccountId $bankAccountId
     */
    public function __construct(BankAccountId $bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }

    /**
     * @param array $payload
     * @return Query|BankAccountDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            BankAccountId::fromValue($payload['bank_account_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'bank_account_id' => $this->getBankAccountId()->scalar()
        ];
    }

    /**
     * @return BankAccountId
     */
    public function getBankAccountId(): BankAccountId
    {
        return $this->bankAccountId;
    }
}
