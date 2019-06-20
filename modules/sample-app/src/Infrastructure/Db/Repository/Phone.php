<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Repository;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Phone as PhoneModel;
use Amazium\SampleApp\Domain\ValueObject\PhoneId;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\Repository\Phone as PhoneRepository;
use Amazium\SampleApp\Domain\ValueObject\PhoneState;
use Amazium\SampleApp\Infrastructure\Db\Mapper\Phone as PhoneMapper;

class Phone implements PhoneRepository
{
    /**
     * @var Engine
     */
    private $dbEngine;

    /**
     * Phone constructor.
     * @param Engine $dbEngine
     */
    public function __construct(Engine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param PhoneModel $phone
     * @return bool
     */
    public function save(PhoneModel $phone): bool
    {
        if ($phone->getInternalId()) {
            return $this->dbEngine->update(
                'phone',
                PhoneMapper::phoneModelToTableData($phone),
                [ 'id' => $phone->getInternalId()->scalar() ]
            ) !== false;
        } else {
            return $this->dbEngine->insert(
                'phone',
                PhoneMapper::phoneModelToTableData($phone)
            );
        }
    }

    /**
     * @param PhoneId $phoneId
     * @return PhoneModel|null
     * @throws \Exception
     */
    public function findById(PhoneId $phoneId): ?PhoneModel
    {
        $results = $this->dbEngine->find('phone', [ 'id' => $phoneId->scalar() ]);
        if (count($results) === 1) {
            return PhoneMapper::tableDataToPhoneModel($results[0]);
        }
        return null;
    }

    /**
     * @param PhoneId $phoneId
     * @return array|null
     * @throws \Exception
     */
    public function fetchById(PhoneId $phoneId): ?array
    {
        $results = $this->dbEngine->find('v_phone_detail', [ 'phone_id' => $phoneId->scalar() ]);
        if (count($results) === 1) {
            return $results[0];
        }
        return null;
    }

    /**
     * @param string|null $provider
     * @param PhoneState|null $state
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(?string $provider = null, ?PhoneState $state = null, ?IdentityId $identityId = null): array
    {
        $where = [];
        if (!is_null($provider)) {
            $where['provider'] = $provider;
        }
        if (!is_null($state)) {
            $where['state'] = $state->scalar();
        }
        if (!is_null($identityId)) {
            $where['identity_id'] = $identityId->scalar();
        }
        return $this->dbEngine->find(
            'v_phone_overview',
            $where
        );
    }
}
