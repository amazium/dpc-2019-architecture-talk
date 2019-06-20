<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\Repository\BankAccount as BankAccountRepository;

abstract class AbstractBankAccountFetcher
{
    /**
     * @var BankAccountRepository
     */
    protected $bankAccounts;

    /**
     * BankAccountDetailsAbstractFetcher constructor.
     * @param BankAccountRepository $bankAccounts
     */
    public function __construct(BankAccountRepository $bankAccounts)
    {
        $this->bankAccounts = $bankAccounts;
    }

    /**
     * @param Message $queryMessage
     * @return mixed
     */
    public function __invoke(Message $queryMessage)
    {
        return $this->fetch($queryMessage->payload(), $queryMessage->context());
    }
}
