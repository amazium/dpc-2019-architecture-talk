<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Identity\Domain\Aggregate\Account;
use Amazium\Kernel\Application\Context\ApplicationContext;
use Amazium\Kernel\Application\Message\Message;

class RegisterHandlerImpl extends RegisterAbstractHandler
{
    /**
     * @param Register $registration
     * @param ApplicationContext $context
     * @return array
     */
    public function handle(Register $registration, ApplicationContext $context): array
    {
        $account = Account::register(
            $registration->getAccountId(),
            $registration->getName(),
            $registration->getEmailAddress(),
            $registration->getPassword()
        );
        $this->accounts->save($account);
        return [
            'account_id' => $account->getAccountId()->scalar(),
        ];
    }
}
