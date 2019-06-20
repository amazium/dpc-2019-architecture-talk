<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-29}
 */

namespace Amazium\Kernel\Application\Message\Contract;

use Zend\Expressive\Authentication\UserInterface;

interface AuthenticatedUserInjectable
{
    /**
     * @param UserInterface $user
     * @return mixed
     */
    public function setAuthenticatedUser(?UserInterface $user);
}
