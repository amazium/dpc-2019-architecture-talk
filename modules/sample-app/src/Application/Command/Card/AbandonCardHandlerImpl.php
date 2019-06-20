<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Context\Context;

class AbandonCardHandlerImpl extends AbstractCardHandler implements AbandonCardHandler
{
    /**
     * @param AbandonCard $abandonCard
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(AbandonCard $abandonCard, Context $context): array
    {
        $card = $this->cards->findById($abandonCard->getCardId());
        $card->abandon();
        $this->cards->save($card);
        return [
            'card_id' => $abandonCard->getCardId()->scalar(),
        ];
    }
}
