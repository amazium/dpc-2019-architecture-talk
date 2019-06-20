<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\Repository\Phone as PhoneRepository;

abstract class AbstractPhoneFetcher
{
    /**
     * @var PhoneRepository
     */
    protected $phones;

    /**
     * PhoneDetailsAbstractFetcher constructor.
     * @param PhoneRepository $phones
     */
    public function __construct(PhoneRepository $phones)
    {
        $this->phones = $phones;
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
