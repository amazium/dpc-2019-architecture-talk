<?php

return [
    [
        'path' => '/address',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Address\Index::class,
        'methods' => [ 'GET' ],
        'name' => 'address.index',
    ],
    [
        'path' => '/address/:address_id',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Address\Show::class,
        'methods' => [ 'GET' ],
        'name' => 'address.show',
    ],
    [
        'path' => '/address/:address_id/edit',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Address\Update::class,
            \Amazium\SampleApp\UI\Web\Page\Address\Edit::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'address.update',
    ],
    [
        'path' => '/address/:address_id/edit',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Address\Edit::class,
        'methods' => [ 'GET' ],
        'name' => 'address.edit',
    ],
    [
        'path' => '/address/:address_id/delete',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Address\Destroy::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'address.destroy',
    ],
    [
        'path' => '/address/:address_id/activate',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Address\Activate::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'address.activate',
    ],
    [
        'path' => '/address/create',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Address\Create::class,
        'methods' => [ 'GET' ],
        'name' => 'address.create',
    ],
    [
        'path' => '/address/create',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Address\Store::class,
            \Amazium\SampleApp\UI\Web\Page\Address\Create::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'address.store',
    ],

    [
        'path' => '/bank-account',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\BankAccount\Index::class,
        'methods' => [ 'GET' ],
        'name' => 'bank-account.index',
    ],
    [
        'path' => '/bank-account/:bank_account_id',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\BankAccount\Show::class,
        'methods' => [ 'GET' ],
        'name' => 'bank-account.show',
    ],
    [
        'path' => '/bank-account/:bank_account_id/edit',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\BankAccount\Update::class,
            \Amazium\SampleApp\UI\Web\Page\BankAccount\Edit::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'bank-account.update',
    ],
    [
        'path' => '/bank-account/:bank_account_id/edit',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\BankAccount\Edit::class,
        'methods' => [ 'GET' ],
        'name' => 'bank-account.edit',
    ],
    [
        'path' => '/bank-account/:bank_account_id/delete',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\BankAccount\Destroy::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'bank-account.destroy',
    ],
    [
        'path' => '/bank-account/:bank_account_id/activate',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\BankAccount\Activate::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'bank-account.activate',
    ],
    [
        'path' => '/bank-account/create',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\BankAccount\Create::class,
        'methods' => [ 'GET' ],
        'name' => 'bank-account.create',
    ],
    [
        'path' => '/bank-account/create',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\BankAccount\Store::class,
            \Amazium\SampleApp\UI\Web\Page\BankAccount\Create::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'bank-account.store',
    ],

    [
        'path' => '/card',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Card\Index::class,
        'methods' => [ 'GET' ],
        'name' => 'card.index',
    ],
    [
        'path' => '/card/:card_id',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Card\Show::class,
        'methods' => [ 'GET' ],
        'name' => 'card.show',
    ],
    [
        'path' => '/card/:card_id/edit',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Card\Update::class,
            \Amazium\SampleApp\UI\Web\Page\Card\Edit::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'card.update',
    ],
    [
        'path' => '/card/:card_id/edit',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Card\Edit::class,
        'methods' => [ 'GET' ],
        'name' => 'card.edit',
    ],
    [
        'path' => '/card/:card_id/delete',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Card\Destroy::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'card.destroy',
    ],
    [
        'path' => '/card/:card_id/activate',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Card\Activate::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'card.activate',
    ],
    [
        'path' => '/card/create',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Card\Create::class,
        'methods' => [ 'GET' ],
        'name' => 'card.create',
    ],
    [
        'path' => '/card/create',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Card\Store::class,
            \Amazium\SampleApp\UI\Web\Page\Card\Create::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'card.store',
    ],

    [
        'path' => '/identity',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Identity\Index::class,
        'methods' => [ 'GET' ],
        'name' => 'identity.index',
    ],
    [
        'path' => '/identity/:identity_id',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Identity\Show::class,
        'methods' => [ 'GET' ],
        'name' => 'identity.show',
    ],
    [
        'path' => '/identity/:identity_id/edit',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Identity\Update::class,
            \Amazium\SampleApp\UI\Web\Page\Identity\Edit::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'identity.update',
    ],
    [
        'path' => '/identity/:identity_id/edit',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Identity\Edit::class,
        'methods' => [ 'GET' ],
        'name' => 'identity.edit',
    ],
    [
        'path' => '/identity/:identity_id/delete',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Identity\Destroy::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'identity.destroy',
    ],
    [
        'path' => '/identity/:identity_id/activate',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Identity\Activate::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'identity.activate',
    ],
    [
        'path' => '/identity/create',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Identity\Create::class,
        'methods' => [ 'GET' ],
        'name' => 'identity.create',
    ],
    [
        'path' => '/identity/create',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Identity\Store::class,
            \Amazium\SampleApp\UI\Web\Page\Identity\Create::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'identity.store',
    ],

    [
        'path' => '/phone',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Phone\Index::class,
        'methods' => [ 'GET' ],
        'name' => 'phone.index',
    ],
    [
        'path' => '/phone/:phone_id',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Phone\Show::class,
        'methods' => [ 'GET' ],
        'name' => 'phone.show',
    ],
    [
        'path' => '/phone/:phone_id/edit',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Phone\Update::class,
            \Amazium\SampleApp\UI\Web\Page\Phone\Edit::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'phone.update',
    ],
    [
        'path' => '/phone/:phone_id/edit',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Phone\Edit::class,
        'methods' => [ 'GET' ],
        'name' => 'phone.edit',
    ],
    [
        'path' => '/phone/:phone_id/delete',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Phone\Destroy::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'phone.destroy',
    ],
    [
        'path' => '/phone/:phone_id/activate',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Phone\Activate::class,
        ],
        'methods' => [ 'GET' ],
        'name' => 'phone.activate',
    ],
    [
        'path' => '/phone/create',
        'middleware' => \Amazium\SampleApp\UI\Web\Page\Phone\Create::class,
        'methods' => [ 'GET' ],
        'name' => 'phone.create',
    ],
    [
        'path' => '/phone/create',
        'middleware' => [
            \Amazium\SampleApp\UI\Web\Page\Phone\Store::class,
            \Amazium\SampleApp\UI\Web\Page\Phone\Create::class,
        ],
        'methods' => [ 'POST' ],
        'name' => 'phone.store',
    ],
];
