<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Traits;

use Amazium\Kernel\Domain\ValueObject\DateTime\DateTime;

trait InjectInternalTimestamp
{
    /** @var DateTime */
    private $_createdAt;

    /**
     * Set the internal timestamp
     *
     * @param DateTime|string $createdAt
     * @throws \Exception
     */
    protected function setInternalTimestamp($createdAt = 'now')
    {
        if (!$createdAt instanceof DateTime) {
            $createdAt = DateTime::fromValue($createdAt);
        }
        $this->_createdAt = $createdAt;
    }

    /**
     * Get the internal timestamp
     *
     * @return DateTime
     */
    public function createdAt(): DateTime
    {
        return $this->_createdAt;
    }
}
