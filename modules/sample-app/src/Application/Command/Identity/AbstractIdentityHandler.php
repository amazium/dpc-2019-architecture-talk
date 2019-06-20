<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Identity;

use Amazium\SampleApp\Domain\Repository\Identity as IdentityRepository;
use Amazium\Kernel\Application\Message\Message;

abstract class AbstractIdentityHandler
{
    /**
     * @var IdentityRepository
     */
    protected $identities;

    /**
     * AbandonIdentityAbstractHandler constructor.
     * @param IdentityRepository $identities
     */
    public function __construct(IdentityRepository $identities)
    {
        $this->identities = $identities;
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function __invoke(Message $message)
    {
        return $this->handle($message->payload(), $message->context());
    }
}
