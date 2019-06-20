<?php

namespace Amazium\Kernel\Infrastructure\Queue;

interface Queue
{
    /**
     * @param string $message
     * @return mixed
     */
    public function push(string $message);

    /**
     * @return string
     */
    public function pop(): string;

    /**
     * @return bool
     */
    public function hasItems(): bool;
}
