<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Identity;

use Amazium\Kernel\Application\Context\Context;

class ModifyIdentityDetailsHandlerImpl extends AbstractIdentityHandler implements ModifyIdentityDetailsHandler
{
    /**
     * @param ModifyIdentityDetails $modifyIdentityDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyIdentityDetails $modifyIdentityDetails, Context $context): array
    {
        $identity = $this->identities->findById($modifyIdentityDetails->getIdentityId());
        $identity->modifyDetails(
            $modifyIdentityDetails->getFirstName(),
            $modifyIdentityDetails->getLastName(),
            $modifyIdentityDetails->getMiddleName(),
            $modifyIdentityDetails->getBirthDate(),
            $modifyIdentityDetails->getBirthPlace(),
            $modifyIdentityDetails->getBirthCountry(),
            $modifyIdentityDetails->getNationality(),
            $modifyIdentityDetails->getLanguage(),
            $modifyIdentityDetails->getExtraInfo()
        );
        $this->identities->save($identity);
        return [
            'identity_id' => $modifyIdentityDetails->getIdentityId()->scalar(),
        ];
    }
}
