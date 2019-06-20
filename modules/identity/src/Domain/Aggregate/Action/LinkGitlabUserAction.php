<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\Aggregate\Action;

use Amazium\Identity\Domain\Aggregate\Account;
use Amazium\Identity\Domain\ValueObject\AccountExternalIdentifier\GitlabIdentifier;

class LinkGitlabUserAction
{
    /**
     * @param Account $account
     * @param GitlabIdentifier $gitlabIdentifier
     * @return Account
     */
    public function __invoke(Account $account, GitlabIdentifier $gitlabIdentifier): Account
    {
        $account->getExternalIdentifiers()->setGitlab($gitlabIdentifier);
        return $account;
    }
}
