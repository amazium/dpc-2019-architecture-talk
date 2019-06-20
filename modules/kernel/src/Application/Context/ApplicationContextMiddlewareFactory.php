<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-29}
 */

namespace Amazium\Kernel\Application\Context;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Zend\Expressive\Session\LazySession;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Session\SessionPersistenceInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class ApplicationContextMiddlewareFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ApplicationContext|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new ApplicationContextMiddleware(
            $container->get(ApplicationContext::class)
        );
    }
}
