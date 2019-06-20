<?php

namespace Amazium\Kernel\Infrastructure\Db\Engine;

interface Engine
{
    /**
     * @param string $expression
     * @return mixed
     */
    public function expression(string $expression);

    /**
     * @param string $table
     * @param array $data
     * @return int
     */
    public function insert(string $table, array $data): int;

    /**
     * @param string $table
     * @param array $data
     * @param array $where
     * @return bool
     */
    public function update(string $table, array $data, array $where): bool;

    /**
     * @param string $table
     * @param array $where
     * @return mixed
     */
    public function delete(string $table, array $where): bool;

    /**
     * @param string $table
     * @param array $where
     * @return array
     */
    public function find(string $table, array $where): array;
}
