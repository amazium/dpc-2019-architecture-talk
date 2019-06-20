<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-29}
 */

namespace Amazium\Identity\Domain\Entity;

use Amazium\Identity\Domain\Aggregate\Account;
use Amazium\Kernel\Core\Contract\CreatableFromArray;
use Amazium\Kernel\Core\Contract\Extractable;
use Zend\Expressive\Authentication\UserInterface;

class AuthenticatedUser implements UserInterface, Extractable, CreatableFromArray
{
    /**
     * @var string
     */
    private $identity;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var array
     */
    private $details;

    /**
     * AuthenticatedUser constructor.
     * @param string $identity
     * @param array $roles
     * @param array $details
     */
    private function __construct(string $identity, array $roles = [], array $details = [])
    {
        $this->identity = $identity;
        $this->roles    = $roles;
        $this->details  = $details;
    }

    /**
     * @param array $payload
     * @return AuthenticatedUser|CreatableFromArray
     */
    public static function fromArray(array $payload)
    {
        return new static(
            $payload['identity'] ?? null,
            $payload['roles'] ?? [],
            $payload['details'] ?? []
        );
    }

    /**
     * @param Account $account
     * @return AuthenticatedUser
     */
    public static function fromAccount(Account $account): AuthenticatedUser
    {
        return self::fromArray([
            'identity' => $account->getAccountId()->scalar(),
            'roles'    => $account->getRoles(),
            'details'  => $account->getArrayCopy(),
        ]);
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'identity' => $this->getIdentity(),
            'roles'    => $this->getRoles(),
            'details'  => $this->getDetails(),
        ];
    }

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @return iterable
     */
    public function getRoles(): iterable
    {
        return $this->roles;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed|null
     */
    public function getDetail(string $name, $default = null)
    {
        return $this->details[$name] ?? $default;
    }
}
