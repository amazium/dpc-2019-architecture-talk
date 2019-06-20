<?php

namespace Amazium\Kernel\Infrastructure\Log;

use Psr\Log\LoggerAwareTrait;

trait InjectLogger
{
    use LoggerAwareTrait;

    public function log($level, $message, array $context = [])
    {
        if ($this->logger) {
            $this->logger->log($level, $message, $context);
        }
    }
}
