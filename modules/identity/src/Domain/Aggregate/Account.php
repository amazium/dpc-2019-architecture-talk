<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\Aggregate;

use Amazium\Identity\Application\Command\Account\LinkGitlabUser;
use Amazium\Identity\Domain\Aggregate\Action\Register;
use Amazium\Identity\Domain\Aggregate\Action\RegisterUsingGitlab;
use Amazium\Identity\Domain\ValueObject\AccountExternalIdentifier\GitlabIdentifier;
use Amazium\Identity\Domain\ValueObject\ExternalIdentifiers;
use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Identity\Domain\ValueObject\AccountState;
use Amazium\Identity\Domain\ValueObject\SocialAccounts;
use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Core\Exception\BadMethodCallException;
use Amazium\Kernel\Domain\Aggregate\AggregateRoot;
use Amazium\Kernel\Domain\ValueObject\Number\InternalIdentifier;
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Amazium\Kernel\Domain\ValueObject\Text\Password;
use Amazium\Kernel\Domain\ValueObject\Text\Url;

/**
 * Class Account
 *
 * @method static Account register(AccountId $accountId, string $name, EmailAddress $emailAddress, ?Password $password = null)
 * @method static Account registerUsingGitlab(AccountId $accountId, array $gitlabUserData)
 * @method Account linkGitlabUser(GitlabIdentifier $gitlabIdentifier): Account
 */
class Account implements AggregateRoot
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
     * @var string
     */
    private $nickname;

    /**
     * @var EmailAddress
     */
    private $emailAddress;

    /**
     * @var Password
     */
    private $password;

    /**
     * @var Url
     */
    private $avatar;

    /**
     * @var AccountState
     */
    private $state;

    /**
     * @var SocialAccounts
     */
    private $social = [];

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var ExternalIdentifiers
     */
    private $externalIdentifiers = [];

    /**
     * @var InternalIdentifier
     */
    private $internalId;

    /**
     * Account constructor.
     * @param AccountId $accountId
     * @param string $name
     * @param string $nickname
     * @param EmailAddress $emailAddress
     * @param Password $password
     * @param AccountState $state
     * @param Url|null $avatar
     * @param SocialAccounts|null $social
     * @param array $roles
     * @param ExternalIdentifiers|null $externalIdentifiers
     * @param InternalIdentifier|null $internalId
     */
    public function __construct(
        AccountId $accountId,
        string $name,
        string $nickname,
        EmailAddress $emailAddress,
        Password $password,
        AccountState $state,
        ?Url $avatar,
        ?SocialAccounts $social = null,
        array $roles = [],
        ?ExternalIdentifiers $externalIdentifiers = null,
        ?InternalIdentifier $internalId = null
    ) {
        $this->accountId    = $accountId;
        $this->name         = $name;
        $this->nickname     = $nickname;
        $this->emailAddress = $emailAddress;
        $this->password     = $password;
        $this->avatar       = $avatar;
        $this->state        = $state;
        $this->social       = $social;
        $this->roles        = $roles;
        $this->externalIdentifiers = $externalIdentifiers;
        $this->internalId   = $internalId;
    }

    /**
     * @param array $payload
     * @param bool $fromRepository
     * @return Account|AggregateRoot
     * @throws \Exception
     */
    public static function fromArray(array $payload, bool $fromRepository = false)
    {
        return new static(
            AccountId::fromValue($payload['account_id'] ?? null),
            $payload['name'] ?? null,
            $payload['nickname'] ?? null,
            EmailAddress::fromValue($payload['email_address'] ?? null),
            Password::fromValue($payload['password'] ?? null, $fromRepository),
            AccountState::fromValue($payload['state'] ?? null),
            Url::fromValue($payload['avatar'] ?? null),
            SocialAccounts::fromValue($payload['social'] ?? []),
            $payload['roles'] ?? [ 'basic' ],
            ExternalIdentifiers::fromValue($payload['external_identifiers'] ?? []),
            InternalIdentifier::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [
            'account_id' => $this->getAccountId()->scalar(),
            'name' => $this->getName(),
            'nickname' => $this->getNickname(),
            'email_address' => $this->getEmailAddress()->scalar(),
            'password' => $this->getPassword()->scalar(),
            'avatar' => $this->getAvatar()->scalar(),
            'state' => $this->getState()->scalar(),
            'social' => $this->getSocial()->scalar(),
            'roles' => $this->getRoles(),
            'external_identifiers' => $this->getExternalIdentifiers()->scalar(),
            'internal_id' => $this->getInternalId()->scalar(),
        ];
        if (empty($options[Extractable::EXTOPT_UNMASKED_PASSWORD])) {
            $return['password'] = str_repeat('*', 8);
        }
        if (empty($options[Extractable::EXTOPT_INCLUDE_IDENTIFIER])) {
            unset($return['internal_id']);
        }
        if (empty($options[Extractable::EXTOPT_INCLUDE_NULL_VALUES])) {
            foreach ($return as $key => $value) {
                if (is_null($value)) {
                    unset($return[$key]);
                }
            }
        }
        return $return;
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
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
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

    /**
     * @return Url
     */
    public function getAvatar(): Url
    {
        return $this->avatar;
    }

    /**
     * @return AccountState
     */
    public function getState(): AccountState
    {
        return $this->state;
    }

    /**
     * @return SocialAccounts|null
     */
    public function getSocial(): ?SocialAccounts
    {
        return $this->social;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return ExternalIdentifiers|null
     */
    public function getExternalIdentifiers(): ?ExternalIdentifiers
    {
        return $this->externalIdentifiers;
    }

    /**
     * @return InternalIdentifier|null
     */
    public function getInternalId(): ?InternalIdentifier
    {
        return $this->internalId;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        switch ($name) {
            case 'linkGitlabUser':
                return (new LinkGitlabUser())($this, ...$arguments);
        }
        throw new BadMethodCallException(sprintf(
            '%s is not a valid method on %s',
            $name,
            __CLASS__
        ));
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return Account
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        switch ($name) {
            case 'register':
                return (new Register())(...$arguments);
            case 'registerUsingGitlab':
                return (new RegisterUsingGitlab())(...$arguments);
        }
        throw new BadMethodCallException(sprintf(
            '%s is not a valid method on %s',
            $name,
            __CLASS__
        ));
    }
}
