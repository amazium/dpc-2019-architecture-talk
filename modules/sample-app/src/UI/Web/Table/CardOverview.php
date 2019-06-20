<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Table;

use Amazium\Kernel\UI\Web\Table\Table;
use Amazium\SampleApp\Domain\ValueObject\CardState;
use Amazium\SampleApp\Domain\ValueObject\CardType;

class CardOverview extends Table
{
    /**
     * @return string
     */
    public function id(): string
    {
        return 'tbl_card_overview';
    }

    /**
     * @return array
     */
    public function config(): array
    {
        return [
            'buttons' => [
                'show' => [
                    'id' => function ($data) {
                        return 'btn_show_' . $data['id'];
                    },
                    'label' => 'show',
                    'icon'  => 'eye',
                    'action' => 'card.show',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['id'];
                        },
                    ],
                ],
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['id'];
                    },
                    'label' => 'edit',
                    'icon'  => 'pencil-alt',
                    'action' => 'card.edit',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['id'];
                        }
                    ],
                ],
                'activate' => [
                    'id' => function ($data) {
                        return 'btn_activate_' . $data['id'];
                    },
                    'label' => 'activate',
                    'icon'  => 'check-circle',
                    'condition' => function ($data) {
                        return $data['state'] == CardState::STATE_REQUESTED;
                    },
                    'action' => 'card.activate',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['id'];
                        }
                    ],
                    'class' => 'btn-info',
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['id'];
                    },
                    'label' => 'delete',
                    'icon'  => 'trash-alt',
                    'condition' => function ($data) {
                        return $data['state'] !== CardState::STATE_ABANDONED;
                    },
                    'action' => 'card.destroy',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'columns' => [
                [
                    'header' => 'Identity',
                    'key' => 'identity_name',
                    'action' => 'identity.show',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        },
                    ],
                ],
                [
                    'header' => 'Linked Account',
                    'key' => 'bank_account_number',
                    'action' => 'bank-account.show',
                    'action_params' => [
                        'bank_account_id' => function ($data) {
                            return $data['bank_account_id'];
                        },
                    ],
                ],
                [
                    'header' => 'Issuer',
                    'key' => 'issuer',
                ],
                [
                    'header' => 'Card Type',
                    'key' => 'card_type',
                    'value' => function ($data) {
                        return empty($data['card_type']) ? null : CardType::$types[$data['card_type']];
                    },
                ],
                [
                    'header' => 'Card Number',
                    'key' => 'card_number',
                ],
                [
                    'header' => 'Name on Card',
                    'key' => 'name_on_card',
                ],
                [
                    'header' => 'State',
                    'key' => 'state',
                    'value' => function ($data) {
                        return CardState::$states[$data['state']];
                    },
                    'icons' => [
                        CardState::STATE_REQUESTED => 'question-circle',
                        CardState::STATE_ACTIVE => 'check-circle',
                        CardState::STATE_ABANDONED => 'times-circle',
                    ],
                ],
            ],
        ];
    }
}
