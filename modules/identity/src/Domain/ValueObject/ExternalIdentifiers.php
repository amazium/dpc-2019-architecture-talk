<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\ValueObject;

use Amazium\Identity\Domain\ValueObject\AccountExternalIdentifier\GitlabIdentifier;
use Amazium\Kernel\Domain\ValueObject\ValueObject;

class ExternalIdentifiers implements ValueObject
{
    const SOURCE_GITLAB = 'gitlab';

    /**
     * @var GitlabIdentifier|null
     */
    private $gitlab;

    /**
     * ExternalIdentifiers constructor.
     * @param GitlabIdentifier|null $gitlab
     */
    private function __construct(?GitlabIdentifier $gitlab)
    {
        $this->gitlab = $gitlab;
    }

    /**
     * @return array|mixed
     */
    public function value()
    {
        return [
            self::SOURCE_GITLAB => $this->getGitlab()
        ];
    }

    /**
     * @return array|mixed
     */
    public function scalar()
    {
        $return = [];
        if (!is_null($this->gitlab)) {
            $return[ self::SOURCE_GITLAB ] = $this->getGitlab()->scalar();
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
            GitlabIdentifier::fromValue($value[ self::SOURCE_GITLAB ] ?? null)
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
     * @return GitlabIdentifier|null
     */
    public function getGitlab(): ?GitlabIdentifier
    {
        return $this->gitlab;
    }

    /**
     * @param GitlabIdentifier|null $gitlab
     */
    public function setGitlab(?GitlabIdentifier $gitlab): void
    {
        $this->gitlab = $gitlab;
    }
}
