<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Mapper;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Card as CardModel;

class Card
{
    /**
     * @param CardModel $card
     * @param Engine $engine
     * @return array
     */
    public static function cardModelToTableData(CardModel $card): array
    {
        $data = $card->getArrayCopy();
        if (isset($data['id'])) {
            unset($data['id']);
        }
        if (isset($data['card_id'])) {
            $data['id'] = $data['card_id'];
            unset($data['card_id']);
        }
        if (isset($data['extra_info'])) {
            $data['extra_info'] = json_encode($data['extra_info'], JSON_PRETTY_PRINT);
        }
        return $data;
    }

    /**
     * @param array $payload
     * @return CardModel
     * @throws \Exception
     */
    public static function tableDataToCardModel(array $payload): CardModel
    {
        if (isset($payload['id'])) {
            $payload['internal_id'] = $payload['id'];
            $payload['card_id'] = $payload['id'];
            unset($payload['id']);
        }
        if (isset($payload['extra_info'])) {
            $payload['extra_info'] = json_decode($payload['extra_info'], true);
        }
        return CardModel::fromArray($payload);
    }
}
