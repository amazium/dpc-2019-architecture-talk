<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Context\Context;

class ModifyCardDetailsHandlerImpl extends AbstractCardHandler implements ModifyCardDetailsHandler
{
    /**
     * @param ModifyCardDetails $modifyCardDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyCardDetails $modifyCardDetails, Context $context): array
    {
        $card = $this->cards->findById($modifyCardDetails->getCardId());
        $card->modifyDetails(
            $modifyCardDetails->getIssuer(),
            $modifyCardDetails->getCardType(),
            $modifyCardDetails->getCardNumber(),
            $modifyCardDetails->getNameOnCard(),
            $modifyCardDetails->getValidThru(),
            $modifyCardDetails->getValidFrom(),
            $modifyCardDetails->getCvvCode()
        );
        $this->cards->save($card);
        return [
            'card_id' => $modifyCardDetails->getCardId()->scalar(),
        ];
    }
}
