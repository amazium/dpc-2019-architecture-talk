<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Mapper;

use Amazium\SampleApp\Domain\Aggregate\Identity as IdentityModel;

class Identity
{
    /**
     * @param IdentityModel $identity
     * @return array
     */
    public static function identityModelToTableData(IdentityModel $identity): array
    {
        $data = $identity->getArrayCopy();
        if (isset($data['id'])) {
            unset($data['id']);
        }
        if (isset($data['identity_id'])) {
            $data['id'] = $data['identity_id'];
            unset($data['identity_id']);
        }
        if (isset($data['extra_info'])) {
            $data['extra_info'] = json_encode($data['extra_info'], JSON_PRETTY_PRINT);
        }
        return $data;
    }

    /**
     * @param array $payload
     * @return IdentityModel
     * @throws \Exception
     */
    public static function tableDataToIdentityModel(array $payload): IdentityModel
    {
        if (isset($payload['id'])) {
            $payload['internal_id'] = $payload['id'];
            $payload['identity_id'] = $payload['id'];
            unset($payload['id']);
        }
        if (isset($payload['extra_info'])) {
            $payload['extra_info'] = json_decode($payload['extra_info'], true);
        }
        return IdentityModel::fromArray($payload);
    }
}
