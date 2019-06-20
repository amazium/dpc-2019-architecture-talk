<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Command\Command;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;

class AbandonBankAccount implements Command
{
    /**
     * @var BankAccountId
     */
    private $bankAccountId;

    /**
     * AbandonAddress constructor.
     * @param BankAccountId $bankAccountId
     */
    public function __construct(BankAccountId $bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }

    /**
     * @param array $payload
     * @return Command|void
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
