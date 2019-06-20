<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Table;

use Amazium\Kernel\UI\Web\Table\Table;
use Amazium\SampleApp\Domain\ValueObject\BankAccountState;

class BankAccountOverview extends Table
{
    /**
     * @return string
     */
    public function id(): string
    {
        return 'tbl_bank_account_overview';
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
                        return 'btn_show_' . $data['bank_account_id'];
                    },
                    'label' => 'show',
                    'icon'  => 'eye',
                    'action' => 'bank-account.show',
                    'action_params' => [
                        'bank_account_id' => function ($data) {
                            return $data['bank_account_id'];
                        },
                    ],
                ],
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['bank_account_id'];
                    },
                    'label' => 'edit',
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
                    'label' => 'activate',
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
                    'label' => 'delete',
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
            'columns' => [
                [
                    'header' => 'Identity',
                    'key' => 'identity_name',
                    'action' => 'identity.show',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'] ?? null;
                        },
                    ],
                ],
                [
                    'header' => 'Bank',
                    'key' => 'bank_name',
                ],
                [
                    'header' => 'Account Number',
                    'key' => 'account_number',
                ],
                [
                    'header' => 'Account Owner',
                    'key' => 'name_on_account',
                ],
                [
                    'header' => 'State',
                    'key' => 'state',
                    'value' => function ($data) {
                        return BankAccountState::$states[$data['state']];
                    },
                    'icons' => [
                        'REQUESTED' => 'question-circle',
                        'ACTIVE' => 'check-circle',
                        'ABANDONED' => 'times-circle',
                    ],
                ],
            ],
        ];
    }
}
