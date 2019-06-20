<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-18}
 */

namespace Amazium\Kernel\Infrastructure\Db\Engine;

use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Expression;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\SqlInterface;
use Zend\Stdlib\ArrayUtils;

class ZendSql implements Engine
{
    /**
     * @var Sql
     */
    private $sql;

    /**
     * ZendSql constructor.
     * @param Sql $sql
     */
    public function __construct(Sql $sql)
    {
        $this->sql = $sql;
    }

    /**
     * @param PreparableSqlInterface $query
     * @return ResultInterface
     */
    protected function execute(PreparableSqlInterface $query): ResultInterface
    {
//        echo $this->sql->buildSqlString($query) . PHP_EOL;
        $prepared = $this->sql->prepareStatementForSqlObject($query);
        return $prepared->execute();
    }

    /**
     * @param string $table
     * @param array $data
     * @return int
     */
    public function insert(string $table, array $data): int
    {
        $query = $this->sql->insert($table)->columns(array_keys($data))->values(array_values($data));
        $result = $this->execute($query);
        if ($result instanceof ResultInterface) {
            return $result->getGeneratedValue();
        }
        return 0;
    }

    /**
     * @param string $table
     * @param array $data
     * @param array $where
     * @return bool
     */
    public function update(string $table, array $data, array $where): bool
    {
        $query = $this->sql->update($table)->set($data)->where($where);
        $result = $this->execute($query);
        if ($result instanceof ResultSetInterface) {
            return $result->getAffectedRows() > 0;
        }
        return false;
    }

    /**
     * @param string $table
     * @param array $where
     * @return bool
     */
    public function delete(string $table, array $where): bool
    {
        $query = $this->sql->delete($table)->where($where);
        $this->execute($query);
        return true; // Error will throw exception anyway
    }

    /**
     * @param string $table
     * @param array $where
     * @return array
     */
    public function find(string $table, array $where): array
    {
        $query = $this->sql->select($table)->where($where);
        $result = $this->execute($query);
        if ($result instanceof ResultInterface && $result->count() > 0) {
            return ArrayUtils::iteratorToArray($result);
        }
        return [];
    }

    /**
     * @param string $expression
     * @return mixed|Expression
     */
    public function expression(string $expression)
    {
        return new Expression($expression);
    }
}
