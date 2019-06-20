<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Context\Context;

class ActivateCardHandlerImpl extends AbstractCardHandler implements ActivateCardHandler
{
    /**
     * @param ActivateCard $activateCard
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(ActivateCard $activateCard, Context $context): array
    {
        $card = $this->cards->findById($activateCard->getCardId());
        $card->activate();
        $this->cards->save($card);
        return [
            'card_id' => $activateCard->getCardId()->scalar(),
        ];
    }
}
