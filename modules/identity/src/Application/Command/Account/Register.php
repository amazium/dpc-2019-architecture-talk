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
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Amazium\Kernel\Domain\ValueObject\Text\Password;

class Register implements Command
{
    /**
     * @var AccountId
     */
    private $accountId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @var Password
     */
    private $password;

    /**
     * Register constructor.
     * @param string $name
     * @param EmailAddress $emailAddress
     * @param Password $password
     * @throws \Exception
     */
    public function __construct(
        string $name,
        EmailAddress $emailAddress,
        Password $password
    ) {
        $this->accountId = AccountId::generate();
        $this->name = $name;
        $this->emailAddress = $emailAddress;
        $this->password = $password;
    }

    /**
     * @param array $payload
     * @return RegisterUsingGitlab|Command
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            $payload['name'] ?? null,
            EmailAddress::fromValue($payload['email_address'] ?? null),
            Password::fromValue($payload['password'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'account_id' => $this->getAccountId()->scalar(),
            'name' => $this->getGitlabUserData(),
            'email_address' => $this->getEmailAddress()->scalar(),
            'password' => $this->getPassword()->scalar(),
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return EmailAddress
     */
    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return Password
     */
    public function getPassword(): Password
    {
        return $this->password;
    }
}
