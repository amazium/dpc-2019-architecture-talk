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
use Amazium\SampleApp\Domain\ValueObject\PhoneState;
use Amazium\SampleApp\Domain\ValueObject\PhoneType;

class PhoneDetail extends Detail
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
                        return 'btn_edit_' . $data['phone_id'];
                    },
                    'label' => 'Edit Phone',
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
                    'label' => 'Activate Phone',
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
                    'label' => 'Delete Phone',
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
            'items' => [
                [
                    'label' => 'Identifier',
                    'key' => 'phone_id',
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
                    'label' => 'Provider',
                    'key' => 'provider',
                ],
                [
                    'label' => 'Phone Number',
                    'key' => 'phone_number',
                ],
                [
                    'label' => 'PIN Code',
                    'key' => 'pin_code',
                ],
                [
                    'label' => 'PUK Code',
                    'key' => 'puk_code',
                ],
                [
                    'label' => 'PUK2 code',
                    'key' => 'puk2_code',
                ],
                [
                    'label' => 'State',
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
