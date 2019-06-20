<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity;

use Amazium\Identity\Application\Command\Account\RegisterHandler;
use Amazium\Identity\Application\Command\Account\RegisterHandlerFactory;
use Amazium\Identity\Application\Command\Account\RegisterUsingGitlabHandler;
use Amazium\Identity\Application\Command\Account\RegisterUsingGitlabHandlerFactory;
use Amazium\Identity\Domain\Repository\Account as AccountRepository;
use Amazium\Identity\Infrastructure\Db\Repository\AccountFactory as AccountDbRepositoryFactory;
use Amazium\Identity\UI\Web\Page\Login;
use Amazium\Identity\UI\Web\Page\LoginUsingGitlab;
use Amazium\Identity\UI\Web\Page\Logout;
use Amazium\Kernel\Application\Authentication\AuthenticatedUserRepositoryInterface;
use Amazium\Kernel\UI\Page\PageFactory;
use Zend\Expressive\Authentication\UserRepositoryInterface;

return [
    'aliases' => [
        AuthenticatedUserRepositoryInterface::class => AccountRepository::class,
    ],
    'factories' => [
        Login::class => PageFactory::class,
        LoginUsingGitlab::class => PageFactory::class,
        Logout::class => PageFactory::class,

        RegisterHandler::class => RegisterHandlerFactory::class,
        RegisterUsingGitlabHandler::class => RegisterUsingGitlabHandlerFactory::class,
        AccountRepository::class => AccountDbRepositoryFactory::class,
    ],
];
