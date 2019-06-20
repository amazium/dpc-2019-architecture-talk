<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Repository;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Card as CardModel;
use Amazium\SampleApp\Domain\ValueObject\CardId;
use Amazium\SampleApp\Domain\ValueObject\CardState;
use Amazium\SampleApp\Domain\ValueObject\CardType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\Repository\Card as CardRepository;
use Amazium\SampleApp\Infrastructure\Db\Mapper\Card as CardMapper;

class Card implements CardRepository
{
    /**
     * @var Engine
     */
    private $dbEngine;

    /**
     * Card constructor.
     * @param Engine $dbEngine
     */
    public function __construct(Engine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param CardModel $card
     * @return bool
     */
    public function save(CardModel $card): bool
    {
        if ($card->getInternalId()) {
            return $this->dbEngine->update(
                'card',
                CardMapper::cardModelToTableData($card),
                [ 'id' => $card->getInternalId()->scalar() ]
            ) !== false;
        } else {
            return $this->dbEngine->insert(
                'card',
                CardMapper::cardModelToTableData($card)
            );
        }
    }

    /**
     * @param CardId $cardId
     * @return CardModel|null
     * @throws \Exception
     */
    public function findById(CardId $cardId): ?CardModel
    {
        $results = $this->dbEngine->find('card', [ 'id' => $cardId->scalar() ]);
        if (count($results) === 1) {
            return CardMapper::tableDataToCardModel($results[0]);
        }
        return null;
    }

    /**
     * @param CardId $cardId
     * @return array|null
     */
    public function fetchById(CardId $cardId): ?array
    {
        $results = $this->dbEngine->find('v_card_detail', [ 'card_id' => $cardId->scalar() ]);
        if (count($results) === 1) {
            return $results[0];
        }
        return null;
    }

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
    ): array {
        $where = [];
        if (!is_null($cardType)) {
            $where['card_type'] = $cardType->scalar();
        }
        if (!is_null($issuer)) {
            $where['issuer'] = $issuer;
        }
        if (!is_null($state)) {
            $where['state'] = $state->scalar();
        }
        if (!is_null($identityId)) {
            $where['identity_id'] = $identityId->scalar();
        }
        return $this->dbEngine->find(
            'v_card_overview',
            $where
        );
    }
}
