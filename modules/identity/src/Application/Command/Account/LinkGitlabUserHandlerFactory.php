<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Identity\Domain\Repository\Account as AccountRepository;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class LinkGitlabUserHandlerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new RegisterHandlerImpl(
            $container->get(AccountRepository::class)
        );
    }
}
