<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Identity\Domain\ValueObject\AccountExternalIdentifier\GitlabIdentifier;
use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Kernel\Application\Command\Command;
use Amazium\Kernel\Application\Message\Contract\AuthenticatedUserInjectable;
use Zend\Expressive\Authentication\UserInterface;

class LinkGitlabUser implements Command, AuthenticatedUserInjectable
{
    /** @var AccountId */
    private $accountId;

    /** @var GitlabIdentifier */
    private $gitlabIdentifier;

    /**
     * LinkGitlabUser constructor.
     * @param GitlabIdentifier $gitlabIdentifier
     */
    public function __construct(GitlabIdentifier $gitlabIdentifier)
    {
        $this->gitlabIdentifier = $$gitlabIdentifier;
    }

    /**
     * @param UserInterface|null $user
     * @return mixed|void
     */
    public function setAuthenticatedUser(?UserInterface $user)
    {
        $this->accountId = AccountId::fromValue($user->getIdentity());
    }

    /**
     * @param array $payload
     * @return LinkGitlabUser|Command
     */
    public static function fromArray(array $payload)
    {
        return new static(
            $payload['gitlab_identifier'] ?? null
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'account_id' => $this->accountId->scalar(),
            'gitlab_identifier' => $this->gitlabIdentifier->scalar(),
        ];
    }

    /**
     * @return AccountId
     */
    public function getAccountId(): AccountId
    {
        return $this->accountId;
    }

    /**
     * @return GitlabIdentifier
     */
    public function getGitlabIdentifier(): GitlabIdentifier
    {
        return $this->gitlabIdentifier;
    }
}
