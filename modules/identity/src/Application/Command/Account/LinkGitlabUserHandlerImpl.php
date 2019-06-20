<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Kernel\Application\Context\ApplicationContext;

class LinkGitlabUserHandlerImpl extends LinkGitlabUserAbstractHandler
{
    public function handle(LinkGitlabUser $command, ApplicationContext $context): array
    {
        $account = $this->accounts->findById($command->getAccountId());
        $account->linkGitlabUser($command->getGitlabIdentifier());
        $this->accounts->save($account);
        return [
            'account_id' => $account->getAccountId()->scalar(),
        ];
    }
}
