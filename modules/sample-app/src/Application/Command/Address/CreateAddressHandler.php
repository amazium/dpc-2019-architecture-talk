<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Address;
use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface CreateAddressHandler extends CommandHandler
{
    /**
     * @param CreateAddress $createAddress
     * @param Context $context
     * @return array
     */
    public function handle(CreateAddress $createAddress, Context $context): array;
}
