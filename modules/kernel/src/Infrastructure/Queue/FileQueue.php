<?php

namespace Amazium\Kernel\Infrastructure\Queue;

class FileQueue implements Queue
{
    /**
     * @var resource
     */
    private $queueFile;

    /**
     * @var array
     */
    private $queue;

    /**
     * FileQueue constructor.
     * @param string $queueFile
     */
    public function __construct(string $queueFile)
    {
        $this->queueFile = $queueFile;
        if (!file_exists($queueFile)) {
            if (!is_dir(dirname($queueFile))) {
                mkdir(dirname($queueFile, 0755, true));
            }
        }
        $this->queue = json_decode(file_get_contents($this->queueFile), true);
    }

    /**
     * @param string $message
     * @return bool
     */
    public function push(string $message): bool
    {
        $this->queue[] = $message;
        return $this->saveQueue();
    }

    /**
     * @return string
     */
    public function pop(): string
    {
        $message = array_shift($this->queue);
        $this->saveQueue();
        return $message;
    }

    /**
     * @return bool|int
     */
    protected function saveQueue()
    {
        return @file_put_contents($this->queueFile, json_encode($this->queue, JSON_PRETTY_PRINT));
    }

    /**
     * @return bool
     */
    public function hasItems(): bool
    {
        return count($this->queue) > 0;
    }
}
