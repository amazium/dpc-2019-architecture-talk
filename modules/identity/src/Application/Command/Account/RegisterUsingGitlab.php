<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Kernel\Application\Command\Command;
use Amazium\Kernel\Core\Exception\LogicException;

class RegisterUsingGitlab implements Command
{
    /**
     * @var AccountId
     */
    private $accountId;

    /**
     * @var array
     */
    private $gitlabUserData;

    /**
     * RegisterUsingGitlab constructor.
     * @param array $gitlabUserData
     * @throws \Exception
     */
    public function __construct(array $gitlabUserData)
    {
        $this->accountId = AccountId::generate();
        $this->gitlabUserData = $gitlabUserData;
    }

    /**
     * @param array $payload
     * @return RegisterUsingGitlab|Command
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        if (isset($payload['id'])) {
            return new static($payload);
        } elseif ($payload['gitlab_user_data']) {
            return new static($payload['gitlab_user_data']);
        }
        throw new LogicException('Invalid data provided! ' . var_export($payload, true));
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'account_id' => $this->getAccountId()->scalar(),
            'gitlab_user_data' => $this->getGitlabUserData(),
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
     * @return array
     */
    public function getGitlabUserData(): array
    {
        return $this->gitlabUserData;
    }
}
