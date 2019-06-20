<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Core\Contract;

use Amazium\Kernel\Domain\ValueObject\DateTime\DateTime;

interface Timestamped
{
    /**
     * Created timestamp
     *
     * @return DateTime
     */
    public function createdAt(): DateTime;
}
