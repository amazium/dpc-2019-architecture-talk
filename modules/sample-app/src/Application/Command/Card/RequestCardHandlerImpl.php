<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Aggregate\Card;

class RequestCardHandlerImpl extends AbstractCardHandler implements RequestCardHandler
{
    /**
     * @param RequestCard $requestCard
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(RequestCard $requestCard, Context $context): array
    {
        $card = Card::request(
            $requestCard->getCardId(),
            $requestCard->getIdentityId(),
            $requestCard->getIssuer(),
            $requestCard->getCardType(),
            $requestCard->getCardNumber(),
            $requestCard->getNameOnCard(),
            $requestCard->getValidThru(),
            $requestCard->getValidFrom(),
            $requestCard->getCvvCode(),
            $requestCard->getBankAccountId(),
            $requestCard->getExtraInfo()
        );
        $this->cards->save($card);
        return [
            'card_id' => $requestCard->getCardId()->scalar(),
        ];
    }
}
