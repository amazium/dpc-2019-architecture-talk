<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

declare(strict_types=1);

use Zend\ServiceManager\ServiceManager;

// Load configuration
$config = require __DIR__ . '/config.php';
//if (isset($config['authentication']['redirect'])) {
//    $config['authentication']['redirect'].= '?red=' . urlencode($_SERVER['REQUEST_URI']);
//}

$dependencies = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
