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

class ApplicationContextFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ApplicationContext|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_id($_COOKIE[session_name()] ?? null);
            session_start([
                'use_cookies' => false,
                'use_only_cookies' => true,
                'cache_limiter' => '',
            ]);
        }

        $authenticatedUser = null;
        if (isset($_SESSION[AuthenticatedUser::class])
            && isset($_SESSION[AuthenticatedUser::class]['identity'])
        ) {
            $authenticatedUser = AuthenticatedUser::fromArray($_SESSION[AuthenticatedUser::class]);
        }
        return new ApplicationContext(
            $authenticatedUser
        );
    }
}
