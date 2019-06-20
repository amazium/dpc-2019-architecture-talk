<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Identity;

use Amazium\Kernel\Application\Context\Context;

class AbandonIdentityHandlerImpl extends AbstractIdentityHandler implements AbandonIdentityHandler
{
    /**
     * @param AbandonIdentity $abandonIdentity
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(AbandonIdentity $abandonIdentity, Context $context): array
    {
        $identity = $this->identities->findById($abandonIdentity->getIdentityId());
        $identity->abandon();
        $this->identities->save($identity);
        return [
            'identity_id' => $abandonIdentity->getIdentityId()->scalar(),
        ];
    }
}
