<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Context\Context;

class CardsForOverviewFetcherImpl extends AbstractCardFetcher implements CardsForOverviewFetcher
{
    /**
     * @param CardsForOverview $cardDetails
     * @param Context $context
     * @return array|mixed
     */
    public function fetch(CardsForOverview $cardDetails, Context $context)
    {
        return $this->cards->fetchAll(
            $cardDetails->getCardType(),
            $cardDetails->getIssuer(),
            $cardDetails->getState(),
            $cardDetails->getIdentityId()
        );
    }
}
