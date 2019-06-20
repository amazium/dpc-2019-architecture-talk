<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Card;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\CardId;

class CardDetails implements Query
{
    /**
     * @var CardId
     */
    private $cardId;

    /**
     * CardDetails constructor.
     * @param CardId $cardId
     */
    public function __construct(CardId $cardId)
    {
        $this->cardId = $cardId;
    }

    /**
     * @param array $payload
     * @return Query|CardDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            CardId::fromValue($payload['card_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'card_id' => $this->getCardId()->scalar()
        ];
    }

    /**
     * @return CardId
     */
    public function getCardId(): CardId
    {
        return $this->cardId;
    }
}
