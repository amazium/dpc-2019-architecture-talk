<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Identity;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;

class IdentitiesForOverview implements Query
{
    /**
     * @var IdentityState|null
     */
    private $state;

    /**
     * IdentitiesForOverview constructor.
     * @param IdentityState|null $state
     */
    public function __construct(
        ?IdentityState $state = null
    ) {
        $this->state = $state;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'state' => $this->getState() ? $this->getState()->scalar() : null,
        ];
    }

    /**
     * @param array $payload
     * @return Query|IdentitiesForOverview
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            empty($payload['state']) ? null : IdentityState::fromValue($payload['state'])
        );
    }

    /**
     * @return IdentityState|null
     */
    public function getState(): ?IdentityState
    {
        return $this->state;
    }
}
