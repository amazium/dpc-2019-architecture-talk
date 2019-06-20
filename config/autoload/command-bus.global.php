<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium;

use Amazium\Kernel\Infrastructure\Bus\Middleware\AuthenticatedUserInjector;

return [
    'command_bus' => [
        'middleware' => [
            AuthenticatedUserInjector::class
        ],
    ],
];
