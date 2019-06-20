<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\SampleApp\Domain\Repository\Address as AddressRepository;
use Amazium\Kernel\Application\Message\Message;

abstract class AbstractAddressHandler
{
    /**
     * @var AddressRepository
     */
    protected $addresses;

    /**
     * AbandonAddressAbstractHandler constructor.
     * @param AddressRepository $addresses
     */
    public function __construct(AddressRepository $addresses)
    {
        $this->addresses = $addresses;
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
