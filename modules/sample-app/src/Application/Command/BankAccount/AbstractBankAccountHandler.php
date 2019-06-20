<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\SampleApp\Domain\Repository\BankAccount as BankAccountRepository;
use Amazium\Kernel\Application\Message\Message;

abstract class AbstractBankAccountHandler
{
    /**
     * @var BankAccountRepository
     */
    protected $bankAccounts;

    /**
     * AbandonBankAccountAbstractHandler constructor.
     * @param BankAccountRepository $bankAccounts
     */
    public function __construct(BankAccountRepository $bankAccounts)
    {
        $this->bankAccounts = $bankAccounts;
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function __invoke(Message $message)
    {
        return $this->handle($message->payload(), $message->context());
    }
}
