<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Detail;

use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\Kernel\UI\Web\Detail\Detail;
use Amazium\SampleApp\Domain\ValueObject\BankAccountState;
use Amazium\SampleApp\Domain\ValueObject\BankAccountType;

class BankAccountDetail extends Detail
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
                        return 'btn_edit_' . $data['bank_account_id'];
                    },
                    'label' => 'Edit BankAccount',
                    'icon'  => 'pencil-alt',
                    'action' => 'bank-account.edit',
                    'action_params' => [
                        'bank_account_id' => function ($data) {
                            return $data['bank_account_id'];
                        }
                    ],
                ],
                'activate' => [
                    'id' => function ($data) {
                        return 'btn_activate_' . $data['bank_account_id'];
                    },
                    'label' => 'Activate BankAccount',
                    'icon'  => 'check-circle',
                    'condition' => function ($data) {
                        return $data['state'] == BankAccountState::STATE_REQUESTED;
                    },
                    'action' => 'bank-account.activate',
                    'action_params' => [
                        'bank_account_id' => function ($data) {
                            return $data['bank_account_id'];
                        }
                    ],
                    'class' => 'btn-info',
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['bank_account_id'];
                    },
                    'label' => 'Delete BankAccount',
                    'icon'  => 'trash-alt',
                    'condition' => function ($data) {
                        return $data['state'] !== BankAccountState::STATE_ABANDONED;
                    },
                    'action' => 'bank-account.destroy',
                    'action_params' => [
                        'bank_account_id' => function ($data) {
                            return $data['bank_account_id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'items' => [
                [
                    'label' => 'Identifier',
                    'key' => 'bank_account_id',
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
                    'label' => 'Card Address',
                    'key' => 'card_address',
                    'action' => 'address.show',
                    'action_params' => [
                        'address_id' => function ($data) {
                            return $data['card_address_id'] ?? null;
                        },
                    ],
                ],
                [
                    'label' => 'Account Number',
                    'key' => 'account_number',
                ],
                [
                    'label' => 'Account Owner',
                    'key' => 'name_on_account',
                ],
                [
                    'label' => 'Bank',
                    'key' => 'bank_name',
                ],
                [
                    'label' => 'Bank Address Line 1',
                    'key' => 'bank_address_line_1',
                ],
                [
                    'label' => 'Bank Address Line 2',
                    'key' => 'bank_address_line_2',
                ],
                [
                    'label' => 'Bank Address Line 3',
                    'key' => 'bank_address_line_3',
                ],
                [
                    'label' => 'State',
                    'key' => 'state',
                    'value' => function ($data) {
                        return BankAccountState::$states[$data['state']];
                    },
                    'icons' => [
                        BankAccountState::STATE_REQUESTED => 'question-circle',
                        BankAccountState::STATE_ACTIVE => 'check-circle',
                        BankAccountState::STATE_ABANDONED => 'times-circle',
                    ],
                ],
            ],
        ];
    }
}
