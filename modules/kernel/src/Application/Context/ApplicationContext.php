<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Application\Context;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;

class ApplicationContext extends ContextArray
{
    /**
     * ApplicationContext constructor.
     * @param AuthenticatedUser|null $authenticatedUser
     */
    public function __construct(AuthenticatedUser $authenticatedUser = null)
    {
        parent::__construct();
        $this['authenticatedUser'] = $authenticatedUser;
    }

    /**
     * @return AuthenticatedUser|null
     */
    public function getAuthenticatedUser(): ?AuthenticatedUser
    {
        return $this['authenticatedUser'];
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [];
        if (!is_null($this->getAuthenticatedUser())) {
            $return['authenticated_user'] = $this->getAuthenticatedUser()->getArrayCopy($options);
        }
        return $return;
    }
}
