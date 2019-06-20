<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\Aggregate\Action;

use Amazium\Identity\Domain\Aggregate\Account;
use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Identity\Domain\ValueObject\AccountState;
use Amazium\Identity\Domain\ValueObject\ExternalIdentifiers;
use Amazium\Identity\Domain\ValueObject\SocialAccounts;
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Amazium\Kernel\Domain\ValueObject\Text\Password;

/**
 * Class RegisterUsingGitlab
 * @package Amazium\Identity\Domain\Aggregate\Action
 */
class RegisterUsingGitlab
{
    /**
     * @param AccountId $accountId
     * @param array $gitlabUserData
     * @return Account
     * @throws \Exception
     */
    public function __invoke(
        AccountId $accountId,
        array $gitlabUserData
    ): Account {
        return new Account(
            $accountId,
            $gitlabUserData['name'] ?? null,
            $gitlabUserData['username'] ?? null,
            EmailAddress::fromValue($gitlabUserData['email']),
            Password::generate(),
            AccountState::fromValue(AccountState::REGISTERED),
            SocialAccounts::fromValue([
                'skype'    => $gitlabUserData['skype'],
                'twitter'  => $gitlabUserData['twitter'],
                'website'  => $gitlabUserData['website_url'],
                'linkedin' => $gitlabUserData['linkedin'],
            ]),
            [],
            ExternalIdentifiers::fromValue([
                ExternalIdentifiers::SOURCE_GITLAB => $gitlabUserData['id'],
            ])
        );
    }
}
