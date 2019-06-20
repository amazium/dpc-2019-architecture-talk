<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Table;

use Amazium\Kernel\UI\Web\Table\Table;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;
use Amazium\SampleApp\Domain\ValueObject\IdentityType;

class IdentityOverview extends Table
{
    /**
     * @return string
     */
    public function id(): string
    {
        return 'tbl_identity_overview';
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
                        return 'btn_show_' . $data['identity_id'];
                    },
                    'label' => 'show',
                    'icon'  => 'eye',
                    'action' => 'identity.show',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        },
                    ],
                ],
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['identity_id'];
                    },
                    'label' => 'edit',
                    'icon'  => 'pencil-alt',
                    'action' => 'identity.edit',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                ],
                'activate' => [
                    'id' => function ($data) {
                        return 'btn_activate_' . $data['identity_id'];
                    },
                    'label' => 'activate',
                    'icon'  => 'check-circle',
                    'condition' => function ($data) {
                        return $data['state'] == IdentityState::STATE_COLLECTING_INFORMATION;
                    },
                    'action' => 'identity.activate',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                    'class' => 'btn-info',
                ],
                [
                    'id' => function ($data) {
                        return 'btn_addresses_for_identity_' . $data['identity_id'];
                    },
                    'label' => 'addresses',
                    'icon'  => 'home',
                    'action' => 'address.index',
                    'action_get_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                    'class' => 'btn-secondary',
                ],
                [
                    'id' => function ($data) {
                        return 'btn_cards_for_identity_' . $data['identity_id'];
                    },
                    'label' => 'cards',
                    'icon'  => 'credit-card',
                    'action' => 'card.index',
                    'action_get_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                    'class' => 'btn-secondary',
                ],
                [
                    'id' => function ($data) {
                        return 'btn_bank_account_for_identity_' . $data['identity_id'];
                    },
                    'label' => 'bank accounts',
                    'icon'  => 'book',
                    'action' => 'bank-account.index',
                    'action_get_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                    'class' => 'btn-secondary',
                ],
                [
                    'id' => function ($data) {
                        return 'btn_phones_for_identity_' . $data['identity_id'];
                    },
                    'label' => 'phones',
                    'icon'  => 'phone',
                    'action' => 'phone.index',
                    'action_get_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                    'class' => 'btn-secondary',
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['identity_id'];
                    },
                    'label' => 'delete',
                    'icon'  => 'trash-alt',
                    'condition' => function ($data) {
                        return $data['state'] !== IdentityState::STATE_ABANDONED;
                    },
                    'action' => 'identity.destroy',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'columns' => [
                [
                    'header' => 'Identifier',
                    'key' => 'identity_id',
                ],
                [
                    'header' => 'First Name',
                    'key' => 'first_name',
                ],
                [
                    'header' => 'Last Name',
                    'key' => 'last_name',
                ],
                'state' => [
                    'header' => 'State',
                    'key' => 'state',
                    'value' => function ($data) {
                        return IdentityState::$states[$data['state']];
                    },
                    'icons' => [
                        IdentityState::STATE_COLLECTING_INFORMATION => 'question-circle',
                        IdentityState::STATE_ACTIVE => 'check-circle',
                        IdentityState::STATE_ABANDONED => 'times-circle',
                    ],
                ],
            ],
        ];
    }
}
