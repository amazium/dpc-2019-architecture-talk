<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Context\Context;

class CardsForIdentityFetcherImpl extends AbstractCardFetcher implements CardsForIdentityFetcher
{
    /**
     * @param CardsForIdentity $cardsForIdentity
     * @param Context $context
     * @return mixed|void
     */
    public function fetch(CardsForIdentity $cardsForIdentity, Context $context)
    {
        return $this->cards->fetchAll(
            $cardsForIdentity->getCardType(),
            $cardsForIdentity->getIssuer(),
            $cardsForIdentity->getState(),
            $cardsForIdentity->getIdentityId()
        );
    }
}
