<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium;

use Amazium\Kernel\Application\Authentication\AmaziumSessionFactory;
use Amazium\Kernel\Application\Context\ApplicationContext;
use Amazium\Kernel\Application\Context\ApplicationContextFactory;
use Amazium\Kernel\Application\Context\ApplicationContextMiddleware;
use Amazium\Kernel\Application\Context\ApplicationContextMiddlewareFactory;
use Amazium\Kernel\Application\Query\Bus\HandlerLocator as QueryBusHandlerLocator;
use Amazium\Kernel\Application\Command\Bus\HandlerLocator as CommandBusHandlerLocator;
use Amazium\Kernel\Core\Session\PhpSessionPersistence;
use Amazium\Kernel\Core\Session\SessionMiddleware;
use Amazium\Kernel\Core\Session\SessionMiddlewareFactory;
use Amazium\Kernel\Infrastructure\Bus\BusFactory;
use Amazium\Kernel\Infrastructure\Bus\CommandNameExtractor\MessagePayloadClassNameExtractor;
use Amazium\Kernel\Infrastructure\Bus\HandlerLocator\ContainerByCommandNameSuffixLocator;
use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\Kernel\Infrastructure\Db\Engine\ZendSql;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;
use League\Tactician\Handler\MethodNameInflector\InvokeInflector;
use League\Tactician\Handler\MethodNameInflector\MethodNameInflector;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Expressive\Authentication\AuthenticationInterface;
use Zend\Expressive\Session\SessionPersistenceInterface;

return [
    'dependencies' => [
        'aliases' => [
            SessionPersistenceInterface::class => PhpSessionPersistence::class,
        ],
        'invokables' => [
            CommandNameExtractor::class => MessagePayloadClassNameExtractor::class,
            MethodNameInflector::class => InvokeInflector::class,
            PhpSessionPersistence::class => PhpSessionPersistence::class,
        ],
        'factories'  => [
            'CommandBus' => BusFactory::class,
            'QueryBus' => BusFactory::class,
            QueryBusHandlerLocator::class => function (ContainerInterface $container) {
                return new ContainerByCommandNameSuffixLocator($container, 'Fetcher');
            },
            CommandBusHandlerLocator::class => function (ContainerInterface $container) {
                return new ContainerByCommandNameSuffixLocator($container, 'Handler');
            },
            ApplicationContext::class => ApplicationContextFactory::class,
            Engine::class => function (ContainerInterface $container) {
                $dbAdapter = $container->get(Adapter::class);
                $sql = new Sql($dbAdapter);
                return new ZendSql($sql);
            },
            AuthenticationInterface::class => AmaziumSessionFactory::class,
            ApplicationContextMiddleware::class => ApplicationContextMiddlewareFactory::class,
        ],
    ],
];
