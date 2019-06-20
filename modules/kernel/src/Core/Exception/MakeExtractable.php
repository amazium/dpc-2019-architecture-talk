<?php

namespace Amazium\Kernel\Core\Exception;

trait MakeExtractable
{
    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $trace = str_replace("\r", "\n", $this->getTraceAsString());
        if ($this->getPrevious()) {
            $trace .= PHP_EOL . str_repeat('-', 20) . PHP_EOL;
            $trace .= str_replace("\r", "\n", $this->getPrevious()->getTraceAsString());
        }

        return [
            'message' => $this->getMessage(),
            'code'    => $this->getCode(),
            'file'    => $this->getFile(),
            'line'    => $this->getLine(),
            'trace'   => $trace,
        ];
    }
}
