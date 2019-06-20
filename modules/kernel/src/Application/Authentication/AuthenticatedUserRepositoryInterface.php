<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Kernel\Application\Authentication;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;

interface AuthenticatedUserRepositoryInterface
{
    /**
     * @param string $username
     * @param string $password
     * @return AuthenticatedUser
     */
    public function authenticateUsingUsernameAndPassword(string $username, string $password): ?AuthenticatedUser;

    /**
     * @param string $source
     * @param $externalIdentifier
     * @return AuthenticatedUser
     */
    public function authenticateUsingExternalIdentifier(string $source, $externalIdentifier): ?AuthenticatedUser;
}
