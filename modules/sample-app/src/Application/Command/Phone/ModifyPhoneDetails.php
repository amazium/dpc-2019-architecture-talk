<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Command\Command;
use Amazium\Kernel\Domain\ValueObject\Text\PhoneNumber;
use Amazium\SampleApp\Domain\ValueObject\PhoneId;

class ModifyPhoneDetails implements Command
{
    /**
     * @var PhoneId
     */
    private $phoneId;

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
     * ModifyPhoneDetails constructor.
     * @param PhoneId $phoneId
     * @param PhoneNumber $phoneNumber
     * @param string $provider
     * @param string $pinCode
     * @param string $pukCode
     * @param string $puk2Code
     * @param array $extraInfo
     */
    public function __construct(
        PhoneId $phoneId,
        PhoneNumber $phoneNumber,
        string $provider,
        string $pinCode,
        string $pukCode,
        string $puk2Code,
        array $extraInfo = []
    ) {
        $this->phoneId = $phoneId;
        $this->phoneNumber = $phoneNumber;
        $this->provider = $provider;
        $this->pinCode = $pinCode;
        $this->pukCode = $pukCode;
        $this->puk2Code = $puk2Code;
        $this->extraInfo = $extraInfo;
    }

    /**
     * @param array $payload
     * @return Command|ModifyPhoneDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            PhoneId::fromValue($payload['phone_id'] ?? null),
            PhoneNumber::fromValue($payload['phone_number'] ?? null),
            $payload['provider'] ?? null,
            $payload['pin_code'] ?? null,
            $payload['puk_code'] ?? null,
            $payload['puk2_code'] ?? null,
            $payload['extra_info'] ?? []
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'phone_id' => $this->getPhoneId()->scalar(),
            'phone_number' => $this->getPhoneNumber()->scalar(),
            'provider' => $this->getPinCode(),
            'pin_code' => $this->getPinCode(),
            'puk_code' => $this->getPukCode(),
            'puk2_code' => $this->getPuk2Code(),
            'extra_info' => $this->getExtraInfo()
        ];
    }

    /**
     * @return PhoneId
     */
    public function getPhoneId(): PhoneId
    {
        return $this->phoneId;
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
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }
}
