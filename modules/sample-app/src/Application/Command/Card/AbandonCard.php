<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Command\Command;
use Amazium\SampleApp\Domain\ValueObject\CardId;

class AbandonCard implements Command
{
    /**
     * @var CardId
     */
    private $cardId;

    /**
     * AbandonAddress constructor.
     * @param CardId $cardId
     */
    public function __construct(CardId $cardId)
    {
        $this->cardId = $cardId;
    }

    /**
     * @param array $payload
     * @return Command|void
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
