<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Application\Query;

use Amazium\Kernel\Application\Message\Message;

interface QueryFetcher
{
    public function __invoke(Message $queryMessage);
}
