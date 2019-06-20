<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\SampleApp\Domain\Repository\Card as CardRepository;
use Amazium\Kernel\Application\Message\Message;

abstract class AbstractCardHandler
{
    /**
     * @var CardRepository
     */
    protected $cards;

    /**
     * AbandonCardAbstractHandler constructor.
     * @param CardRepository $cards
     */
    public function __construct(CardRepository $cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function __invoke(Message $message)
    {
        return $this->handle($message->payload(), $message->context());
    }
}
