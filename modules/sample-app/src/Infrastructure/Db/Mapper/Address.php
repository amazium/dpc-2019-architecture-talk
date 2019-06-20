<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Mapper;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Address as AddressModel;

class Address
{
    /**
     * @param AddressModel $address
     * @param Engine $engine
     * @return array
     */
    public static function addressModelToTableData(AddressModel $address): array
    {
        $data = $address->getArrayCopy();
        if (isset($data['id'])) {
            unset($data['id']);
        }
        if (isset($data['address_id'])) {
            $data['id'] = $data['address_id'];
            unset($data['address_id']);
        }
        if (isset($data['extra_info'])) {
            $data['extra_info'] = json_encode($data['extra_info'], JSON_PRETTY_PRINT);
        }
        return $data;
    }

    /**
     * @param array $payload
     * @return AddressModel
     * @throws \Exception
     */
    public static function tableDataToAddressModel(array $payload): AddressModel
    {
        if (isset($payload['id'])) {
            $payload['internal_id'] = $payload['id'];
            $payload['address_id'] = $payload['id'];
            unset($payload['id']);
        }
        if (isset($payload['extra_info'])) {
            $payload['extra_info'] = json_decode($payload['extra_info'], true);
        }
        return AddressModel::fromArray($payload);
    }
}
