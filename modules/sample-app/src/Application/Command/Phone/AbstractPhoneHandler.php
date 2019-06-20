<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\SampleApp\Domain\Repository\Phone as PhoneRepository;
use Amazium\Kernel\Application\Message\Message;

abstract class AbstractPhoneHandler
{
    /**
     * @var PhoneRepository
     */
    protected $phones;

    /**
     * AbandonPhoneAbstractHandler constructor.
     * @param PhoneRepository $phones
     */
    public function __construct(PhoneRepository $phones)
    {
        $this->phones = $phones;
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
