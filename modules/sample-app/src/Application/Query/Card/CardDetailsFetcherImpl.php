<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Context\Context;

class CardDetailsFetcherImpl extends AbstractCardFetcher implements CardDetailsFetcher
{
    /**
     * @param CardDetails $cardDetails
     * @param Context $context
     * @return mixed
     */
    public function fetch(CardDetails $cardDetails, Context $context)
    {
        return $this->cards->fetchById($cardDetails->getCardId());
    }
}
