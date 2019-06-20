<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Kernel\Application\Authentication;

use Amazium\Kernel\Core\Exception\LogicException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Expressive\Authentication\UserInterface;

class AmaziumSessionFactory
{
    public function __invoke(ContainerInterface $container) : AmaziumSession
    {
        if (! $container->has(AuthenticatedUserRepositoryInterface::class)) {
            throw new LogicException(
                'AuthenticatedUserRepositoryInterface service is missing for authentication'
            );
        }

        $config = $container->get('config')['authentication'] ?? [];

        if (! isset($config['redirect'])) {
            throw new LogicException(
                'The redirect configuration is missing for authentication'
            );
        }

        if (! $container->has(UserInterface::class)) {
            throw new LogicException(
                'UserInterface factory service is missing for authentication'
            );
        }

        return new AmaziumSession(
            $container->get(AuthenticatedUserRepositoryInterface::class),
            $config,
            $container->get(ResponseInterface::class),
            $container->get(UserInterface::class)
        );
    }

}
