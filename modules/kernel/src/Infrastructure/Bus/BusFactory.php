<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Infrastructure\Bus;

use Amazium\Kernel\Application\Command\Bus\HandlerLocator as CommandBusHandlerLocator;
use Amazium\Kernel\Application\Query\Bus\HandlerLocator as QueryBusHandlerLocator;
use Interop\Container\ContainerInterface;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;
use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;
use Zend\ServiceManager\Factory\FactoryInterface;

class BusFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        if ($requestedName == 'CommandBus') {
            $key = 'command_bus';
            $locator = CommandBusHandlerLocator::class;
        } elseif ($requestedName == 'QueryBus') {
            $key = 'query_bus';
            $locator = QueryBusHandlerLocator::class;
        } else {
            throw new \Exception(sprintf('Unknown Bus %s', $requestedName));
        }
        $middleware = $config[$key]['middleware'] ?? [];
        $middleware[] = new CommandHandlerMiddleware(
            $container->get(CommandNameExtractor::class),
            $container->get($locator),
            $container->get(MethodNameInflector::class)
        );
        foreach ($middleware as $mk => $mw) {
            if (is_string($mw)) {
                $middleware[$mk] = $container->has($mw) ? $container->get($mw) : new $mw();
            }
        }
        return new CommandBus($middleware);
    }
}
