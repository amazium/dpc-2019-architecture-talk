<?php

namespace Amazium\Kernel\Infrastructure\Db\Engine;

use Amazium\Kernel\Core\Exception\Exception;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class EngineAwareFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        if (!$container->get(Engine::class)) {
            throw new Exception('No implementation specified for: ' . Engine::class);
        }
        return new $requestedName($container->get(Engine::class));
    }
}
