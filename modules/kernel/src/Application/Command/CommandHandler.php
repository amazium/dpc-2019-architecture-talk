<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Application\Command;

use Amazium\Kernel\Application\Message\Message;

interface CommandHandler
{
    public function __invoke(Message $commandMessage);
}
