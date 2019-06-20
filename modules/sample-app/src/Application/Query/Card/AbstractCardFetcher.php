<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\Repository\Card as CardRepository;

abstract class AbstractCardFetcher
{
    /**
     * @var CardRepository
     */
    protected $cards;

    /**
     * CardDetailsAbstractFetcher constructor.
     * @param CardRepository $cards
     */
    public function __construct(CardRepository $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param Message $queryMessage
     * @return mixed
     */
    public function __invoke(Message $queryMessage)
    {
        return $this->fetch($queryMessage->payload(), $queryMessage->context());
    }
}
