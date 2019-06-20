<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Traits;

use Amazium\Kernel\Domain\ValueObject\Uuid;

trait InjectInternalIdentifier
{
    /** @var int|string|Uuid */
    private $_id;

    /**
     * Set the internal identifier
     *
     * @param int|string|Uuid $id
     */
    protected function setInternalIdentifier($id)
    {
        $this->_id = $id;
    }

    /**
     * Get the internal identifier
     *
     * @return int|string|Uuid
     */
    public function id()
    {
        return $this->_id;
    }
}
