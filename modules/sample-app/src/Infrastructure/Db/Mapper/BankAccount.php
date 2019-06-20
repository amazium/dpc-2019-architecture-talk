<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Mapper;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\BankAccount as BankAccountModel;

class BankAccount
{
    /**
     * @param BankAccountModel $bankAccount
     * @param Engine $engine
     * @return array
     */
    public static function bankAccountModelToTableData(BankAccountModel $bankAccount): array
    {
        $data = $bankAccount->getArrayCopy();
        if (isset($data['id'])) {
            unset($data['id']);
        }
        if (isset($data['bank_account_id'])) {
            $data['id'] = $data['bank_account_id'];
            unset($data['bank_account_id']);
        }
        if (isset($data['extra_info'])) {
            $data['extra_info'] = json_encode($data['extra_info'], JSON_PRETTY_PRINT);
        }
        return $data;
    }

    /**
     * @param array $payload
     * @return BankAccountModel
     * @throws \Exception
     */
    public static function tableDataToBankAccountModel(array $payload): BankAccountModel
    {
        if (isset($payload['id'])) {
            $payload['internal_id'] = $payload['id'];
            $payload['bank_account_id'] = $payload['id'];
            unset($payload['id']);
        }
        if (isset($payload['extra_info'])) {
            $payload['extra_info'] = json_decode($payload['extra_info'], true);
        }
        return BankAccountModel::fromArray($payload);
    }
}
