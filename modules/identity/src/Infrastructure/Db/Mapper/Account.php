<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Infrastructure\Db\Mapper;

use Amazium\Identity\Domain\Aggregate\Account as AccountModel;

class Account
{
    /**
     * @param AccountModel $account
     * @return mixed
     */
    public static function mapModelToTables(AccountModel $account)
    {
        // Basic account record
        $social = $account->getSocial() ?: [];
        $data['account'] = [
            'id' => $account->getInternalId(),
            'uuid' => $account->getAccountId()->scalar(),
            'name' => $account->getName(),
            'nickname' => $account->getNickname(),
            'email_address' => $account->getEmailAddress()->scalar(),
            'password' => $account->getPassword()->scalar(),
            'avatar' => $account->getAvatar()->scalar(),
            'social' => json_encode($social, JSON_PRETTY_PRINT),
            'state' => $account->getState()->scalar(),
        ];

        // Account roles
        $roles = $account->getRoles() ?: [];
        foreach ($roles as $role) {
            $data['account_roles'][] = [
                'account_id' => &$data['account']['id'],
                'role_id'    => $role,
            ];
        }

        // Account external identifiers
        $externalIdentifiers = $account->getExternalIdentifiers() ? $account->getExternalIdentifiers()->scalar() : [];
        foreach ($externalIdentifiers as $source => $externalIdentifier) {
            $data['account_external_identifiers'][] = [
                'account_id'          => &$data['account']['id'],
                'source'              => $source,
                'external_identifier' => $externalIdentifier,
            ];
        }

        return $data;
    }

    /**
     * @param array $data
     * @return AccountModel|null
     * @throws \Exception
     */
    public static function mapTablesToModels(array $data): ?AccountModel
    {
        if (empty($data['account'])) {
            return null;
        }

        // Create base account info
        $payload = [ 'account_id' => $data['account']['uuid'] ]
                 + $data['account']
                 + [ 'internal_id' => $data['account']['id'] ];
        $payload['social_accounts'] = json_decode($payload['social_accounts'] ?? '{}', true);
        unset($payload['uuid']);
        unset($payload['id']);

        // Add roles information
        if ($data['account_roles']) {
            $roles = [];
            foreach ($data['account_roles'] as $role) {
                $roles[] = $role['role_id'];
            }
            $payload['roles'] = $roles;
        }

        // Add external identifiers information
        if ($data['account_external_identifiers']) {
            $externalIdentifiers = [];
            foreach ($data['account_external_identifiers'] as $externalIdentifier) {
                $externalIdentifiers[$externalIdentifier['source']] = $externalIdentifier['external_identifier'];
            }
            $payload['external_identifiers'] = $externalIdentifiers;
        }

        // Return a new account
        return AccountModel::fromArray($payload, true);
    }
}
