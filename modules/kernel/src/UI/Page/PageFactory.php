<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-29}
 */

namespace Amazium\Kernel\UI\Page;

use Amazium\Kernel\Application\Context\ApplicationContext;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Session\SessionPersistenceInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class PageFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return mixed|object
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $applicationContext = $container->get(ApplicationContext::class);
        $commandBus = $container->get('CommandBus');
        $queryBus = $container->get('QueryBus');
        $templateRenderer = $container->has(TemplateRendererInterface::class)
                          ? $container->get(TemplateRendererInterface::class)
                          : null;
        $config = $container->get('config');
        $config[SessionPersistenceInterface::class] = $container->get(SessionPersistenceInterface::class);
        return new $requestedName($applicationContext, $commandBus, $queryBus, $templateRenderer, $config);
    }
}
