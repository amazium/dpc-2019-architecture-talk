<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Table;

use Amazium\Kernel\UI\Web\Table\Table;
use Amazium\SampleApp\Domain\ValueObject\PhoneState;
use Amazium\SampleApp\Domain\ValueObject\PhoneType;

class PhoneOverview extends Table
{
    /**
     * @return string
     */
    public function id(): string
    {
        return 'tbl_phone_overview';
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
                        return 'btn_show_' . $data['phone_id'];
                    },
                    'label' => 'show',
                    'icon'  => 'eye',
                    'action' => 'phone.show',
                    'action_params' => [
                        'phone_id' => function ($data) {
                            return $data['phone_id'];
                        },
                    ],
                ],
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['phone_id'];
                    },
                    'label' => 'edit',
                    'icon'  => 'pencil-alt',
                    'action' => 'phone.edit',
                    'action_params' => [
                        'phone_id' => function ($data) {
                            return $data['phone_id'];
                        }
                    ],
                ],
                'activate' => [
                    'id' => function ($data) {
                        return 'btn_activate_' . $data['phone_id'];
                    },
                    'label' => 'activate',
                    'icon'  => 'check-circle',
                    'condition' => function ($data) {
                        return $data['state'] == PhoneState::STATE_PENDING_ACTIVATION;
                    },
                    'action' => 'phone.activate',
                    'action_params' => [
                        'phone_id' => function ($data) {
                            return $data['phone_id'];
                        }
                    ],
                    'class' => 'btn-info',
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['phone_id'];
                    },
                    'label' => 'delete',
                    'icon'  => 'trash-alt',
                    'condition' => function ($data) {
                        return $data['state'] !== PhoneState::STATE_ABANDONED;
                    },
                    'action' => 'phone.destroy',
                    'action_params' => [
                        'phone_id' => function ($data) {
                            return $data['phone_id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'columns' => [
                'provider' => [
                    'header' => 'Provider',
                    'key' => 'provider',
                ],
                'phone_number' => [
                    'header' => 'Phone Number',
                    'key' => 'phone_number',
                ],
                'state' => [
                    'header' => 'State',
                    'key' => 'state',
                    'value' => function ($data) {
                        return PhoneState::$states[$data['state']];
                    },
                    'icons' => [
                        PhoneState::STATE_PENDING_ACTIVATION => 'question-circle',
                        PhoneState::STATE_ACTIVE => 'check-circle',
                        PhoneState::STATE_ABANDONED => 'times-circle',
                    ],
                ],
            ],
        ];
    }
}
