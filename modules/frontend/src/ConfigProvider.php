<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Frontend;

use Amazium\Kernel\UI\Web\Form\TwigZendFormExtension;

class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => require_once __DIR__ . '/../config/dependencies.config.php',
            'routes' => require_once __DIR__ . '/../config/routes.config.php',
            'templates' => require_once __DIR__ . '/../config/templates.config.php',
        ];
    }
}
