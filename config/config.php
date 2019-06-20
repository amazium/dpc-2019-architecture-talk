<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

declare(strict_types=1);

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \Zend\HttpHandlerRunner\ConfigProvider::class,
    \Zend\Expressive\ZendView\ConfigProvider::class,
//    \Zend\Expressive\Twig\ConfigProvider::class,
    \Zend\Expressive\Router\ZendRouter\ConfigProvider::class,
    \Zend\Router\ConfigProvider::class,
    \Zend\Validator\ConfigProvider::class,
    \Zend\Db\ConfigProvider::class,

    \Zend\Form\ConfigProvider::class,
    \Zend\InputFilter\ConfigProvider::class,
    \Zend\Filter\ConfigProvider::class,
    \Zend\Validator\ConfigProvider::class,
    \Zend\Hydrator\ConfigProvider::class,

    \Zend\Expressive\Authentication\ConfigProvider::class,
    \Zend\Expressive\Authentication\Session\ConfigProvider::class,
    \Zend\Expressive\Session\ConfigProvider::class,
    \Zend\Expressive\Session\Ext\ConfigProvider::class,

    new ArrayProvider($cacheConfig),

    \Zend\Expressive\Helper\ConfigProvider::class,
    \Zend\Expressive\ConfigProvider::class,
    \Zend\Expressive\Router\ConfigProvider::class,

    // Default App module config
    Amazium\Frontend\ConfigProvider::class,
    Amazium\Identity\ConfigProvider::class,
    Amazium\SampleApp\ConfigProvider::class,

    // Load application config in a pre-defined order in such a way that local settings
    // overwrite global settings. (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
    // Load development config if it exists
    new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
