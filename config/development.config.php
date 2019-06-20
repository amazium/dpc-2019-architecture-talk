<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

declare(strict_types=1);

use Zend\ConfigAggregator\ConfigAggregator;

return [
    'debug' => true,
    ConfigAggregator::ENABLE_CACHE => false,
];
