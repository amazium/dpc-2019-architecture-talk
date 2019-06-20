<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\Aggregate;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Domain\Aggregate\AggregateRoot;
use Amazium\Kernel\Domain\ValueObject\DateTime\Date;
use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\Kernel\Domain\ValueObject\Text\Language;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\ValueObject\IdentityState;

class Identity implements AggregateRoot
{
    /**
     * @var IdentityId
     */
    private $identityId;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var IdentityState
     */
    private $state;

    /**
     * @var string|null
     */
    private $middleName;

    /**
     * @var Date|null
     */
    private $birthDate;

    /**
     * @var string|null
     */
    private $birthPlace;

    /**
     * @var Country|null
     */
    private $birthCountry;

    /**
     * @var Country|null
     */
    private $nationality;

    /**
     * @var Language|null
     */
    private $language;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * @var IdentityId|null
     */
    private $internalId;

    /**
     * Identity constructor.
     * @param IdentityId $identityId
     * @param string $firstName
     * @param string $lastName
     * @param IdentityState $state
     * @param string|null $middleName
     * @param Date|null $birthDate
     * @param string|null $birthPlace
     * @param Country|null $birthCountry
     * @param Country|null $nationality
     * @param Language|null $language
     * @param array $extraInfo
     * @param IdentityId|null $internalId
     */
    public function __construct(
        IdentityId $identityId,
        string $firstName,
        string $lastName,
        IdentityState $state,
        ?string $middleName = null,
        ?Date $birthDate = null,
        ?string $birthPlace = null,
        ?Country $birthCountry = null,
        ?Country $nationality = null,
        ?Language $language = null,
        array $extraInfo = [],
        ?IdentityId $internalId = null
    ) {
        $this->identityId = $identityId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->state = $state;
        $this->middleName = $middleName;
        $this->birthDate = $birthDate;
        $this->birthPlace = $birthPlace;
        $this->birthCountry = $birthCountry;
        $this->nationality = $nationality;
        $this->language = $language;
        $this->extraInfo = $extraInfo;
        $this->internalId = $internalId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [
            'identity_id' => $this->getIdentityId()->scalar(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'middle_name' => $this->getMiddleName() ? $this->getMiddleName() : null,
            'birth_date' => $this->getBirthDate() ? $this->getBirthDate()->scalar() : null,
            'birth_place' => $this->getBirthPlace() ? $this->getBirthPlace() : null,
            'birth_country' => $this->getBirthCountry() ? $this->getBirthCountry()->scalar() : null,
            'nationality' => $this->getNationality() ? $this->getNationality()->scalar() : null,
            'language' => $this->getLanguage() ? $this->getLanguage()->scalar() : null,
            'extra_info' => $this->getExtraInfo(),
            'state' => $this->getState()->scalar(),
        ];
        if (empty($options[Extractable::EXTOPT_INCLUDE_IDENTIFIER])) {
            unset($return['internal_id']);
        }
        return $return;
    }

    /**
     * @param array $payload
     * @return AggregateRoot|Identity
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            IdentityId::fromValue($payload['identity_id'] ?? null),
            $payload['first_name'] ?? null,
            $payload['last_name'] ?? null,
            IdentityState::fromValue($payload['state'] ?? null),
            $payload['middle_name'] ?? null,
            Date::fromValue($payload['birth_date'] ?? null),
            $payload['birth_place'] ?? null,
            Country::fromValue($payload['birth_country'] ?? null),
            Country::fromValue($payload['nationality'] ?? null),
            Language::fromValue($payload['language'] ?? null),
            $payload['extra_info'] ?? [],
            IdentityId::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return IdentityState
     */
    public function getState(): IdentityState
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @return Date|null
     */
    public function getBirthDate(): ?Date
    {
        return $this->birthDate;
    }

    /**
     * @return string|null
     */
    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    /**
     * @return Country|null
     */
    public function getBirthCountry(): ?Country
    {
        return $this->birthCountry;
    }

    /**
     * @return Country|null
     */
    public function getNationality(): ?Country
    {
        return $this->nationality;
    }

    /**
     * @return Language|null
     */
    public function getLanguage(): ?Language
    {
        return $this->language;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }

    /**
     * @return IdentityId|null
     */
    public function getInternalId(): ?IdentityId
    {
        return $this->internalId;
    }

    /**
     * @param IdentityId $identityId
     * @param string $firstName
     * @param string $lastName
     * @param string|null $middleName
     * @param Date|null $birthDate
     * @param string|null $birthPlace
     * @param Country|null $birthCountry
     * @param Country|null $nationality
     * @param Language|null $language
     * @param array $extraInfo
     * @return Identity
     * @throws \Exception
     */
    public static function create(
        IdentityId $identityId,
        string $firstName,
        string $lastName,
        ?string $middleName = null,
        ?Date $birthDate = null,
        ?string $birthPlace = null,
        ?Country $birthCountry = null,
        ?Country $nationality = null,
        ?Language $language = null,
        array $extraInfo = []
    ): Identity {
        return new static(
            $identityId,
            $firstName,
            $lastName,
            IdentityState::fromValue(IdentityState::STATE_COLLECTING_INFORMATION),
            $middleName,
            $birthDate,
            $birthPlace,
            $birthCountry,
            $nationality,
            $language,
            $extraInfo
        );
    }

    /**
     * @throws \Exception
     */
    public function activate(): void
    {
        $this->state = IdentityState::fromValue(IdentityState::STATE_ACTIVE);
    }

    /**
     * @throws \Exception
     */
    public function abandon(): void
    {
        $this->state = IdentityState::fromValue(IdentityState::STATE_ABANDONED);
    }

    /**
     * @param IdentityId $identityId
     * @param string $firstName
     * @param string $lastName
     * @param string|null $middleName
     * @param Date|null $birthDate
     * @param string|null $birthPlace
     * @param Country|null $birthCountry
     * @param Country|null $nationality
     * @param Language|null $language
     * @param array $extraInfo
     */
    public function modifyDetails(
        string $firstName,
        string $lastName,
        ?string $middleName = null,
        ?Date $birthDate = null,
        ?string $birthPlace = null,
        ?Country $birthCountry = null,
        ?Country $nationality = null,
        ?Language $language = null,
        array $extraInfo = []
    ): void {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->middleName = $middleName;
        $this->birthDate = $birthDate;
        $this->birthPlace = $birthPlace;
        $this->birthCountry = $birthCountry;
        $this->nationality = $nationality;
        $this->language = $language;
        $this->extraInfo = $extraInfo;
    }
}
