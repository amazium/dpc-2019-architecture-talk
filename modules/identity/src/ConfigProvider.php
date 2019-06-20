<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => require_once __DIR__ . '/../config/dependencies.config.php',
            'routes' => require_once __DIR__ . '/../config/routes.config.php',
            'templates' => require_once __DIR__ . '/../config/templates.config.php',
        ];
    }
}
