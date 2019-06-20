<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Infrastructure\Bus\CommandNameExtractor;

use Amazium\Kernel\Application\Message\Message;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor;

class MessagePayloadClassNameExtractor implements CommandNameExtractor
{
    /**
     * @param object $command
     * @return string
     */
    public function extract($command)
    {
        if ($command instanceof Message) {
            return get_class($command->payload());
        }
        return get_class($command);
    }
}
