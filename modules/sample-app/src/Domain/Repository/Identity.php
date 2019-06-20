<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Repository;

use Amazium\Kernel\Domain\Repository\Repository;
use Amazium\SampleApp\Domain\Aggregate\Identity as IdentityModel;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;

interface Identity extends Repository
{
    /**
     * @param IdentityModel $identity
     * @return bool
     */
    public function save(IdentityModel $identity): bool;

    /**
     * @param IdentityId $identityId
     * @return IdentityModel|null
     */
    public function findById(IdentityId $identityId): ?IdentityModel;

    /**
     * @param IdentityId $identityId
     * @return array|null
     */
    public function fetchById(IdentityId $identityId): ?array;

    /**
     * @param IdentityState|null $state
     * @return array
     */
    public function fetchAll(?IdentityState $state = null): array;
}
