<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-29}
 */

namespace Amazium\Kernel\Infrastructure\Bus\Middleware;

use Amazium\Kernel\Application\Context\ApplicationContext;
use Amazium\Kernel\Application\Message\Contract\AuthenticatedUserInjectable;
use Amazium\Kernel\Application\Message\Message;
use League\Tactician\Middleware;

class AuthenticatedUserInjector implements Middleware
{
    public function execute($command, callable $next)
    {
        if (!(
            $command instanceof Message &&
            $command->context() instanceof ApplicationContext &&
            $command->payload() instanceof AuthenticatedUserInjectable
        )) {
            return $next($command);
        }
        $command->payload()->setAuthenticatedUser($command->context()->getAuthenticatedUser());
        return $next($command);
    }
}
