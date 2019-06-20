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
use Amazium\Kernel\Domain\ValueObject\Text\PhoneNumber;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\ValueObject\PhoneId;
use Amazium\SampleApp\Domain\ValueObject\PhoneState;

class Phone implements AggregateRoot
{
    /**
     * @var PhoneId
     */
    private $phoneId;

    /**
     * @var IdentityId
     */
    private $identityId;

    /**
     * @var string
     */
    private $provider;

    /**
     * @var PhoneNumber
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $pinCode;

    /**
     * @var string
     */
    private $pukCode;

    /**
     * @var string
     */
    private $puk2Code;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * @var PhoneState
     */
    private $state;

    /**
     * @var PhoneId|null
     */
    private $internalId;

    /**
     * Phone constructor.
     * @param PhoneId $phoneId
     * @param IdentityId $identityId
     * @param PhoneNumber $phoneNumber
     * @param string $provider
     * @param string $pinCode
     * @param string $pukCode
     * @param string $puk2Code
     * @param PhoneState $phoneState
     * @param array $extraInfo
     * @param PhoneId|null $internalId
     */
    public function __construct(
        PhoneId $phoneId,
        IdentityId $identityId,
        PhoneNumber $phoneNumber,
        string $provider,
        string $pinCode,
        string $pukCode,
        string $puk2Code,
        PhoneState $phoneState,
        array $extraInfo = [],
        ?PhoneId $internalId = null
    ) {
        $this->phoneId = $phoneId;
        $this->identityId = $identityId;
        $this->phoneNumber = $phoneNumber;
        $this->provider = $provider;
        $this->pinCode = $pinCode;
        $this->pukCode = $pukCode;
        $this->puk2Code = $puk2Code;
        $this->extraInfo = $extraInfo;
        $this->state = $phoneState;
        $this->internalId = $internalId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [
            'phone_id' => $this->getPhoneId()->scalar(),
            'identity_id' => $this->getIdentityId()->scalar(),
            'provider' => $this->getProvider(),
            'phone_number' => $this->getPhoneNumber()->scalar(),
            'pin_code' => $this->getPinCode(),
            'puk_code' => $this->getPukCode(),
            'puk2_code' => $this->getPuk2Code(),
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
     * @return AggregateRoot|Phone
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            PhoneId::fromValue($payload['phone_id'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null),
            PhoneNumber::fromValue($payload['phone_number'] ?? null),
            $payload['provider'] ?? null,
            $payload['pin_code'] ?? null,
            $payload['puk_code'] ?? null,
            $payload['puk2_code'] ?? null,
            PhoneState::fromValue($payload['state'] ?? null),
            $payload['extra_info'] ?? [],
            PhoneId::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @return PhoneId
     */
    public function getPhoneId(): PhoneId
    {
        return $this->phoneId;
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return PhoneNumber
     */
    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getPinCode(): string
    {
        return $this->pinCode;
    }

    /**
     * @return string
     */
    public function getPukCode(): string
    {
        return $this->pukCode;
    }

    /**
     * @return string
     */
    public function getPuk2Code(): string
    {
        return $this->puk2Code;
    }

    /**
     * @return PhoneState
     */
    public function getState(): PhoneState
    {
        return $this->state;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }

    /**
     * @return PhoneId
     */
    public function getInternalId(): ?PhoneId
    {
        return $this->internalId;
    }

    /**
     * @param PhoneId $phoneId
     * @param IdentityId $identityId
     * @param PhoneNumber $phoneNumber
     * @param string $provider
     * @param string $pinCode
     * @param string $pukCode
     * @param string $puk2Code
     * @param array $extraInfo
     * @return Phone
     * @throws \Exception
     */
    public static function register(
        PhoneId $phoneId,
        IdentityId $identityId,
        PhoneNumber $phoneNumber,
        string $provider,
        string $pinCode,
        string $pukCode,
        string $puk2Code,
        array $extraInfo = []
    ): Phone {
        return new static(
            $phoneId,
            $identityId,
            $phoneNumber,
            $provider,
            $pinCode,
            $pukCode,
            $puk2Code,
            PhoneState::fromValue(PhoneState::STATE_PENDING_ACTIVATION),
            $extraInfo
        );
    }

    /**
     * @throws \Exception
     */
    public function activate(): void
    {
        $this->state = PhoneState::fromValue(PhoneState::STATE_ACTIVE);
    }

    /**
     * @throws \Exception
     */
    public function abandon(): void
    {
        $this->state = PhoneState::fromValue(PhoneState::STATE_ABANDONED);
    }

    /**
     * @param PhoneNumber $phoneNumber
     * @param string $pinCode
     * @param string $pukCode
     * @param string $puk2Code
     * @param array $extraInfo
     */
    public function modifyDetails(
        PhoneNumber $phoneNumber,
        string $pinCode,
        string $pukCode,
        string $puk2Code,
        array $extraInfo = []
    ): void {
        $this->phoneNumber = $phoneNumber;
        $this->pinCode = $pinCode;
        $this->pukCode = $pukCode;
        $this->puk2Code = $puk2Code;
        $this->extraInfo = $extraInfo;
    }
}
