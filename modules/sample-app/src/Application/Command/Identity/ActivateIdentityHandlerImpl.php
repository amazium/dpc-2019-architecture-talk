<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Identity;

use Amazium\Kernel\Application\Context\Context;

class ActivateIdentityHandlerImpl extends AbstractIdentityHandler implements ActivateIdentityHandler
{
    /**
     * @param ActivateIdentity $activateIdentity
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(ActivateIdentity $activateIdentity, Context $context): array
    {
        $identity = $this->identities->findById($activateIdentity->getIdentityId());
        $identity->activate();
        $this->identities->save($identity);
        return [
            'identity_id' => $activateIdentity->getIdentityId()->scalar(),
        ];
    }
}
