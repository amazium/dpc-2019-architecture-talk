<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Identity;

use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\Repository\Identity as IdentityRepository;

abstract class AbstractIdentitiesFetcher
{
    /**
     * @var IdentityRepository
     */
    protected $identities;

    /**
     * IdentitiesForOverviewAbstractFetcher constructor.
     * @param IdentityRepository $identities
     */
    public function __construct(IdentityRepository $identities)
    {
        $this->identities = $identities;
    }

    /**
     * @param Message $queryMessage
     * @return mixed
     */
    public function __invoke(Message $queryMessage)
    {
        return $this->fetch($queryMessage->payload(), $queryMessage->context());
    }
}
