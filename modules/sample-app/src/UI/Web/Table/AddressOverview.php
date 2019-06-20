<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Table;

use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\Kernel\UI\Web\Table\Table;
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;

class AddressOverview extends Table
{
    /**
     * @return string
     */
    public function id(): string
    {
        return 'tbl_address_overview';
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
                        return 'btn_show_' . $data['address_id'];
                    },
                    'label' => 'show',
                    'icon'  => 'eye',
                    'action' => 'address.show',
                    'action_params' => [
                        'address_id' => function ($data) {
                            return $data['address_id'];
                        },
                    ],
                ],
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['address_id'];
                    },
                    'label' => 'edit',
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
                    'label' => 'activate',
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
                    'label' => 'delete',
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
            'columns' => [
                'address_type' => [
                    'header' => 'Type',
                    'key' => 'address_type',
                    'value' => function ($data) {
                        return AddressType::$addressTypes[$data['address_type']];
                    },
                    'icons' => [
                        AddressType::TYPE_PRIMARY => 'home',
                        AddressType::TYPE_ADDITIONAL => 'briefcase',
                        AddressType::TYPE_POSTBOX => 'inbox',
                        AddressType::TYPE_FORWARDING => 'random',
                    ]
                ],
                [
                    'header' => 'Identity',
                    'key' => 'identity_name',
                    'action' => 'identity.show',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'] ?? null;
                        }
                    ],
                ],
                'street' => [
                    'header' => 'Street',
                    'key' => 'street'
                ],
                'city' => [
                    'header' => 'City',
                    'key' => 'city',
                ],
                'country' => [
                    'header' => 'Country',
                    'key' => 'country',
                    'value' => function ($data) {
                        return Country::$countries[$data['country']];
                    },
                ],
                'state' => [
                    'header' => 'State',
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
