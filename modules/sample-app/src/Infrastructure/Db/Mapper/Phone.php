<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Mapper;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Phone as PhoneModel;

class Phone
{
    /**
     * @param PhoneModel $phone
     * @param Engine $engine
     * @return array
     */
    public static function phoneModelToTableData(PhoneModel $phone): array
    {
        $data = $phone->getArrayCopy();
        if (isset($data['id'])) {
            unset($data['id']);
        }
        if (isset($data['phone_id'])) {
            $data['id'] = $data['phone_id'];
            unset($data['phone_id']);
        }
        if (isset($data['extra_info'])) {
            $data['extra_info'] = json_encode($data['extra_info'], JSON_PRETTY_PRINT);
        }
        return $data;
    }

    /**
     * @param array $payload
     * @return PhoneModel
     * @throws \Exception
     */
    public static function tableDataToPhoneModel(array $payload): PhoneModel
    {
        if (isset($payload['id'])) {
            $payload['internal_id'] = $payload['id'];
            $payload['phone_id'] = $payload['id'];
            unset($payload['id']);
        }
        if (isset($payload['extra_info'])) {
            $payload['extra_info'] = json_decode($payload['extra_info'], true);
        }
        return PhoneModel::fromArray($payload);
    }
}
