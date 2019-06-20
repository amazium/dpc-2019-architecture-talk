<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Identity;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Aggregate\Identity;

class CreateIdentityHandlerImpl extends AbstractIdentityHandler implements CreateIdentityHandler
{
    /**
     * @param CreateIdentity $createIdentity
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(CreateIdentity $createIdentity, Context $context): array
    {
        $identity = Identity::create(
            $createIdentity->getIdentityId(),
            $createIdentity->getFirstName(),
            $createIdentity->getLastName(),
            $createIdentity->getMiddleName(),
            $createIdentity->getBirthDate(),
            $createIdentity->getBirthPlace(),
            $createIdentity->getBirthCountry(),
            $createIdentity->getNationality(),
            $createIdentity->getLanguage(),
            $createIdentity->getExtraInfo()
        );
        $this->identities->save($identity);
        return [
            'identity_id' => $createIdentity->getIdentityId()->scalar(),
        ];
    }
}
