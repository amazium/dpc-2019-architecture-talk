<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Frontend;

use Amazium\Frontend\UI\Web\Page\Home;
use Amazium\Frontend\UI\Web\Page\Page1;
use Amazium\Frontend\UI\Web\Page\Page2;
use Amazium\Frontend\UI\Web\Page\Page3;
use Zend\Expressive\Authentication\AuthenticationMiddleware;

return [
    [
        'name' => 'frontend.home',
        'path' => '/',
        'middleware' => Home::class,
        'methods' => [ 'GET' ],
    ],
    [
        'name' => 'frontend.page1',
        'path' => '/page/1',
        'middleware' => [
//            AuthenticationMiddleware::class,
            Page1::class,
        ],
        'methods' => [ 'GET' ],
    ],
    [
        'name' => 'frontend.page2',
        'path' => '/page/2',
        'middleware' => [
//            AuthenticationMiddleware::class,
            Page2::class,
        ],
        'methods' => [ 'GET', 'POST' ],
    ],
    [
        'name' => 'frontend.page3',
        'path' => '/page/3',
        'middleware' => [
            Page3::class
        ],
        'methods' => [ 'GET', 'POST' ],
    ],
];
