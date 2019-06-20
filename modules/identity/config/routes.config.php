<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity;

use Amazium\Identity\UI\Web\Page\LinkGitlabUser;
use Amazium\Identity\UI\Web\Page\Login;
use Amazium\Identity\UI\Web\Page\LoginUsingGitlab;
use Amazium\Identity\UI\Web\Page\Logout;
use Zend\Expressive\Authentication\AuthenticationMiddleware;

return [
    [
        'name' => 'account.login',
        'path' => '/account/login',
        'methods' => [ 'GET', 'POST' ],
        'middleware' => [
            Login::class,
            AuthenticationMiddleware::class,
        ],
    ],
    [
        'name' => 'account.login.gitlab',
        'path' => '/account/login/gitlab',
        'methods' => [ 'GET', 'POST' ],
        'middleware' => [
            LoginUsingGitlab::class,
            AuthenticationMiddleware::class
        ],
    ],
    [
        'name' => 'account.logout',
        'path' => '/account/logout',
        'methods' => [ 'GET' ],
        'middleware' => Logout::class
    ],
    [
        'name' => 'account.link-gitlab-account',
        'path' => '/account/link/gitlab',
        'methods' => [ 'GET', 'POST' ],
        'middleware' => [
            AuthenticationMiddleware::class,
            LinkGitlabUser::class,
        ],
    ],
//    [
//        'name' => 'account.profile',
//        'path' => '/account/profile',
//        'methods' => [ 'GET' ],
//    ],
//    [
//        'name' => 'account.request-password',
//        'path' => '/account/request-password',
//        'methods' => [ 'GET', 'POST' ],
//    ],
//    [
//        'name' => 'account.change-password',
//        'path' => '/account/change-password',
//        'methods' => [ 'GET', 'POST' ],
//    ],
//    [
//        'name' => 'account.activate',
//        'path' => '/account/activate',
//        'methods' => [ 'GET' ],
//    ],
];
