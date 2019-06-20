<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Repository;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Identity as IdentityModel;
use Amazium\SampleApp\Domain\Aggregate\Identityes;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\Repository\Identity as IdentityRepository;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;
use Amazium\SampleApp\Infrastructure\Db\Mapper\Identity as IdentityMapper;

class Identity implements IdentityRepository
{
    /**
     * @var Engine
     */
    private $dbEngine;

    /**
     * Identity constructor.
     * @param Engine $dbEngine
     */
    public function __construct(Engine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param IdentityModel $identity
     * @return bool
     */
    public function save(IdentityModel $identity): bool
    {
        if ($identity->getInternalId()) {
            return $this->dbEngine->update(
                'identity',
                IdentityMapper::identityModelToTableData($identity),
                [ 'id' => $identity->getInternalId()->scalar() ]
            ) !== false;
        } else {
            return $this->dbEngine->insert(
                'identity',
                IdentityMapper::identityModelToTableData($identity)
            );
        }
    }

    /**
     * @param IdentityId $identityId
     * @return IdentityModel|null
     * @throws \Exception
     */
    public function findById(IdentityId $identityId): ?IdentityModel
    {
        $results = $this->dbEngine->find('identity', [ 'id' => $identityId->scalar() ]);
        if (count($results) === 1) {
            return IdentityMapper::tableDataToIdentityModel($results[0]);
        }
        return null;
    }

    /**
     * @param IdentityId $identityId
     * @return array|null
     */
    public function fetchById(IdentityId $identityId): ?array
    {
        $results = $this->dbEngine->find('v_identity_detail', [ 'identity_id' => $identityId->scalar() ]);
        if (count($results) === 1) {
            return $results[0];
        }
        return null;
    }

    /**
     * @param IdentityState|null $state
     * @return array
     */
    public function fetchAll(?IdentityState $state = null): array
    {
        $where = [];
        if (!is_null($state)) {
            $where['state'] = $state->scalar();
        }
        return $this->dbEngine->find(
            'v_identity_overview',
            $where
        );
    }
}
