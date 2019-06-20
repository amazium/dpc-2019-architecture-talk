<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Repository;

use Amazium\Kernel\Domain\Repository\Repository;
use Amazium\SampleApp\Domain\Aggregate\Phone as PhoneModel;
use Amazium\SampleApp\Domain\ValueObject\PhoneId;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\ValueObject\PhoneState;

interface Phone extends Repository
{
    /**
     * @param PhoneModel $phone
     * @return bool
     */
    public function save(PhoneModel $phone): bool;

    /**
     * @param PhoneId $phoneId
     * @return PhoneModel|null
     */
    public function findById(PhoneId $phoneId): ?PhoneModel;

    /**
     * @param PhoneId $phoneId
     * @return PhoneModel|null
     */
    public function fetchById(PhoneId $phoneId): ?array;

    /**
     * @param string|null $provider
     * @param PhoneState|null $state
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(
        ?string $provider = null,
        ?PhoneState $state = null,
        ?IdentityId $identityId = null
    ): array;
}
