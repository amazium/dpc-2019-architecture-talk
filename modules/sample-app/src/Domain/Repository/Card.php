<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Repository;

use Amazium\Kernel\Domain\Repository\Repository;
use Amazium\SampleApp\Domain\Aggregate\Card as CardModel;
use Amazium\SampleApp\Domain\ValueObject\CardId;
use Amazium\SampleApp\Domain\ValueObject\CardState;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

interface Card extends Repository
{
    /**
     * @param CardModel $card
     * @return bool
     */
    public function save(CardModel $card): bool;

    /**
     * @param CardId $cardId
     * @return CardModel|null
     */
    public function findById(CardId $cardId): ?CardModel;

    /**
     * @param CardId $cardId
     * @return array|null
     */
    public function fetchById(CardId $cardId): ?array;

    /**
     * @param CardType|null $cardType
     * @param string|null $issuer
     * @param CardState|null $state
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(
        ?CardType $cardType = null,
        ?string $issuer = null,
        ?CardState $state = null,
        ?IdentityId $identityId = null
    ): array;
}
