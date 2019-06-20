<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Detail;

use Amazium\Kernel\UI\Web\Detail\Detail;
use Amazium\SampleApp\Domain\ValueObject\CardState;

class CardDetail extends Detail
{
    /**
     * @return array
     */
    public function config(): array
    {
        return [
            'actions' => [
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['card_id'];
                    },
                    'label' => 'Edit Card',
                    'icon'  => 'pencil-alt',
                    'action' => 'card.edit',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['card_id'];
                        }
                    ],
                ],
                'activate' => [
                    'id' => function ($data) {
                        return 'btn_activate_' . $data['card_id'];
                    },
                    'label' => 'Activate Card',
                    'icon'  => 'check-circle',
                    'condition' => function ($data) {
                        return $data['state'] == CardState::STATE_REQUESTED;
                    },
                    'action' => 'card.activate',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['card_id'];
                        }
                    ],
                    'class' => 'btn-info',
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['card_id'];
                    },
                    'label' => 'Delete Card',
                    'icon'  => 'trash-alt',
                    'condition' => function ($data) {
                        return $data['state'] !== CardState::STATE_ABANDONED;
                    },
                    'action' => 'card.destroy',
                    'action_params' => [
                        'card_id' => function ($data) {
                            return $data['card_id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'items' => [
                [
                    'label' => 'Identifier',
                    'key' => 'card_id',
                ],
                [
                    'label' => 'Identity',
                    'key' => 'identity_name',
                    'action' => 'identity.show',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'] ?? null;
                        },
                    ],
                ],
                [
                    'label' => 'Issuer',
                    'key' => 'issuer',
                ],
                [
                    'label' => 'Card Type',
                    'key' => 'card_type',
                ],
                [
                    'label' => 'Card Number',
                    'key' => 'card_number',
                ],
                [
                    'label' => 'Card Owner',
                    'key' => 'name_on_card',
                ],
                [
                    'label' => 'Valid From',
                    'key' => 'valid_from',
                ],
                [
                    'label' => 'Valid Thru',
                    'key' => 'valid_thru',
                ],
                [
                    'label' => 'CVV Code',
                    'key' => 'cvv_code',
                ],
                [
                    'label' => 'Picture (front)',
                    'key' => 'front_document_id',
                    'action' => 'document.show',
                    'action_params' => [
                        'document_id' => function ($data) {
                            return $data['front_document_id'] ?? null;
                        },
                    ],
                ],
                [
                    'label' => 'Picture (back)',
                    'key' => 'back_document_id',
                    'action' => 'document.show',
                    'action_params' => [
                        'document_id' => function ($data) {
                            return $data['back_document_id'] ?? null;
                        },
                    ],
                ],
                [
                    'label' => 'Linked Account',
                    'key' => 'bank_account_number',
                    'action' => 'bank-account.show',
                    'action_params' => [
                        'bank_account_id' => function ($data) {
                            return $data['bank_account_id'] ?? null;
                        },
                    ],
                ],
                [
                    'label' => 'State',
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
