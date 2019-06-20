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
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;

class AddressDetail extends Detail
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
                        return 'btn_edit_' . $data['address_id'];
                    },
                    'label' => 'Edit Address',
                    'icon'  => 'pencil-alt',
                    'action' => 'address.edit',
                    'action_params' => [
                        'address_id' => function ($data) {
                            return $data['address_id'];
                        }
                    ],
                ],
                'activate' => [
                    'id' => function ($data) {
                        return 'btn_activate_' . $data['address_id'];
                    },
                    'label' => 'Activate Address',
                    'icon'  => 'check-circle',
                    'condition' => function ($data) {
                        return $data['state'] == AddressState::STATE_PENDING;
                    },
                    'action' => 'address.activate',
                    'action_params' => [
                        'address_id' => function ($data) {
                            return $data['address_id'];
                        }
                    ],
                    'class' => 'btn-info',
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['address_id'];
                    },
                    'label' => 'Delete Address',
                    'icon'  => 'trash-alt',
                    'condition' => function ($data) {
                        return $data['state'] !== AddressState::STATE_ABANDONED;
                    },
                    'action' => 'address.destroy',
                    'action_params' => [
                        'address_id' => function ($data) {
                            return $data['address_id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'items' => [
                [
                    'label' => 'Identifier',
                    'key' => 'address_id',
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
                    'label' => 'Type',
                    'key' => 'address_type',
                    'value' => function ($data) {
                        return AddressType::$addressTypes[$data['address_type']];
                    },
                    'icons' => [
                        AddressType::TYPE_PRIMARY => 'home',
                        AddressType::TYPE_ADDITIONAL => 'briefcase',
                        AddressType::TYPE_POSTBOX => 'inbox',
                        AddressType::TYPE_FORWARDING => 'random',
                    ],
                ],
                [
                    'label' => 'Building',
                    'key' => 'building',
                ],
                [
                    'label' => 'Street',
                    'key' => 'street',
                ],
                [
                    'label' => 'Number',
                    'key' => 'number',
                ],
                [
                    'label' => 'Box',
                    'key' => 'box',
                ],
                [
                    'label' => 'ZIP code',
                    'key' => 'zipcode',
                ],
                [
                    'label' => 'City',
                    'key' => 'city',
                ],
                [
                    'label' => 'Region',
                    'key' => 'region',
                ],
                [
                    'label' => 'Country',
                    'key' => 'country',
                    'value' => function ($data) {
                        return !empty($data['country']) ? Country::$countries[$data['country']] : '';
                    },
                ],
                [
                    'label' => 'Active From',
                    'key' => 'active_from',
                ],
                [
                    'label' => 'Active Until',
                    'key' => 'active_until',
                ],
                [
                    'label' => 'State',
                    'key' => 'state',
                    'value' => function ($data) {
                        return AddressState::$states[$data['state']];
                    },
                    'icons' => [
                        AddressState::STATE_PENDING => 'question-circle',
                        AddressState::STATE_ACTIVE => 'check-circle',
                        AddressState::STATE_ABANDONED => 'times-circle',
                    ],
                ],
            ],
        ];
    }
}
