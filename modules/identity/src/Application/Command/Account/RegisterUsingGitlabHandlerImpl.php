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

class RegisterUsingGitlabHandlerImpl extends RegisterUsingGitlabAbstractHandler
{
    /**
     * @param RegisterUsingGitlab $registration
     * @param ApplicationContext $context
     * @return array
     */
    public function handle(RegisterUsingGitlab $registration, ApplicationContext $context): array
    {
        $account = Account::registerUsingGitlab(
            $registration->getAccountId(),
            $registration->getGitlabUserData()
        );
        $this->accounts->save($account);
        return [
            'account_id' => $account->getAccountId()->scalar(),
        ];
    }
}
