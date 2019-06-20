<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Identity;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class IdentityDetails implements Query
{
    /**
     * @var IdentityId
     */
    private $identityId;

    /**
     * IdentityDetails constructor.
     * @param IdentityId $identityId
     */
    public function __construct(IdentityId $identityId)
    {
        $this->identityId = $identityId;
    }

    /**
     * @param array $payload
     * @return Query|IdentityDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            IdentityId::fromValue($payload['identity_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'identity_id' => $this->getIdentityId()->scalar()
        ];
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }
}
