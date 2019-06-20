<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\Repository\Address as AddressRepository;

abstract class AbstractAddressFetcher
{
    /**
     * @var AddressRepository
     */
    protected $addresses;

    /**
     * AddressDetailsAbstractFetcher constructor.
     * @param AddressRepository $addresses
     */
    public function __construct(AddressRepository $addresses)
    {
        $this->addresses = $addresses;
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
