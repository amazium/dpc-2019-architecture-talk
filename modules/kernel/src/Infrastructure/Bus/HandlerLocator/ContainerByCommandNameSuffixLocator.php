<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Infrastructure\Bus\HandlerLocator;

use Amazium\Kernel\Infrastructure\Bus\HandlerLocator\Exception\HandlerNotFoundException;
use League\Tactician\Handler\Locator\HandlerLocator;
use Psr\Container\ContainerInterface;

class ContainerByCommandNameSuffixLocator implements HandlerLocator
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    private $suffix;

    /**
     * ContainerByCommandNameSuffixLocator constructor.
     * @param ContainerInterface $container
     * @param string $suffix
     */
    public function __construct(ContainerInterface $container, string $suffix = 'Handler')
    {
        $this->container = $container;
        $this->suffix    = ucfirst($suffix);
    }

    /**
     * @param string $commandName
     * @return object
     * @throws HandlerNotFoundException
     */
    public function getHandlerForCommand($commandName)
    {
        $handlerName = $commandName . $this->suffix;
        if (!$this->container->has($handlerName)) {
            throw HandlerNotFoundException::withHandlerName($handlerName);
        }
        return $this->container->get($handlerName);
    }
}
