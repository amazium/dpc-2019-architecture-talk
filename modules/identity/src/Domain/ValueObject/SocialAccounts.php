<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\ValueObject;

use Amazium\Identity\Domain\ValueObject\SocialAccount\LinkedIn;
use Amazium\Identity\Domain\ValueObject\SocialAccount\Skype;
use Amazium\Identity\Domain\ValueObject\SocialAccount\Twitter;
use Amazium\Identity\Domain\ValueObject\SocialAccount\Website;
use Amazium\Kernel\Domain\ValueObject\ValueObject;

class SocialAccounts implements ValueObject
{
    /**
     * @var ?GitlabIdentifier
     */
    private $skype;

    /**
     * @var ?Twitter
     */
    private $twitter;

    /**
     * @var ?Website
     */
    private $website;

    /**
     * @var ?LinkedIn
     */
    private $linkedIn;

    /**
     * SocialAccounts constructor.
     * @param Skype|null $skype
     * @param Twitter|null $twitter
     * @param Website|null $website
     * @param LinkedIn|null $linkedIn
     */
    private function __construct(?Skype $skype, ?Twitter $twitter, ?Website $website, ?LinkedIn $linkedIn)
    {
        $this->skype    = $skype;
        $this->twitter  = $twitter;
        $this->website  = $website;
        $this->linkedIn = $linkedIn;
    }

    /**
     * @return array|mixed
     */
    public function value()
    {
        return [
            'skype'    => $this->getSkype(),
            'twitter'  => $this->getTwitter(),
            'website'  => $this->getWebsite(),
            'linkedin' => $this->getLinkedIn(),
        ];
    }

    /**
     * @return array|mixed
     */
    public function scalar()
    {
        $return = [];
        if (!is_null($this->skype)) {
            $return['skype'] = $this->getSkype()->scalar();
        }
        if (!is_null($this->twitter)) {
            $return['twitter'] = $this->getTwitter()->scalar();
        }
        if (!is_null($this->website)) {
            $return['website'] = $this->getWebsite()->scalar();
        }
        if (!is_null($this->linkedIn)) {
            $return['linkedIn'] = $this->getLinkedIn()->scalar();
        }
        return $return;
    }

    /**
     * @param mixed $value
     * @return static
     */
    public static function fromValue($value)
    {
        return new static(
            Skype::fromValue($value['skype'] ?? null),
            Twitter::fromValue($value['twitter'] ?? null),
            Website::fromValue($value['website'] ?? null),
            LinkedIn::fromValue($value['linkedin'] ?? null)
        );
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return is_array($value);
    }

    /**
     * @return Skype|null
     */
    public function getSkype(): ?Skype
    {
        return $this->skype;
    }

    /**
     * @return Twitter|null
     */
    public function getTwitter(): ?Twitter
    {
        return $this->twitter;
    }

    /**
     * @return Website|null
     */
    public function getWebsite(): ?Website
    {
        return $this->website;
    }

    /**
     * @return LinkedIn|null
     */
    public function getLinkedIn(): ?LinkedIn
    {
        return $this->linkedIn;
    }
}
