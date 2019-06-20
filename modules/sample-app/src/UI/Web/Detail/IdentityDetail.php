<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Detail;

use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\Kernel\Domain\ValueObject\Text\Language;
use Amazium\Kernel\UI\Web\Detail\Detail;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;

class IdentityDetail extends Detail
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
                        return 'btn_edit_' . $data['identity_id'];
                    },
                    'label' => 'Edit Identity',
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
                    'label' => 'Activate Identity',
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
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['identity_id'];
                    },
                    'label' => 'Delete Identity',
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
            'items' => [
                [
                    'label' => 'Identifier',
                    'key' => 'identity_id',
                ],
                [
                    'label' => 'First Name',
                    'key' => 'first_name',
                ],
                [
                    'label' => 'Middle Name',
                    'key' => 'middle_name',
                ],
                [
                    'label' => 'Last Name',
                    'key' => 'last_name',
                ],
                [
                    'label' => 'Birth Date',
                    'key' => 'birth_date',
                ],
                [
                    'label' => 'Birth Place',
                    'key' => 'birth_place',
                ],
                [
                    'label' => 'Birth Country',
                    'key' => 'country',
                    'value' => function ($data) {
                        return Country::$countries[$data['nationality']];
                    }
                ],
                [
                    'label' => 'Nationality',
                    'key' => 'nationality',
                    'value' => function ($data) {
                        return Country::$countries[$data['nationality']];
                    }
                ],
                [
                    'label' => 'Language',
                    'key' => 'language',
                    'value' => function ($data) {
                        return Language::$languages[$data['language']];
                    }
                ],
                [
                    'label' => 'State',
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
