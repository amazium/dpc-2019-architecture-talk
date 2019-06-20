<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Traits;

trait InjectObjectName
{
    /** @var string */
    private $_name;

    /**
     * Set the object name
     *
     * @param string $name
     */
    protected function setObjectName($name)
    {
        $this->_name = $name;
    }

    /**
     * Get the object name
     *
     * @return string
     */
    public function name()
    {
        return $this->_name;
    }
}
