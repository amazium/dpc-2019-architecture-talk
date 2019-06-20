<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Kernel\Domain\ValueObject\Text;

class Password extends AbstractText
{
    /**
     * @return Password|null
     */
    public static function defaultReturnValue()
    {
        return static::generate();
    }

    /**
     * @param string $value
     * @param bool $fromRepository
     * @return AbstractText
     */
    public static function fromValue($value, bool $fromRepository = false)
    {
        if (!is_null($value) && !$fromRepository) {
            $value = password_hash($value, PASSWORD_BCRYPT, ['cost' => 12]);
        }
        return parent::fromValue($value);
    }

    /**
     * @return Password
     */
    public static function generate(): Password
    {
        $password = '';
        for ($length = 0; $length < 16; $length++) {
            $password .= chr(rand(32, 126));
        }
        return self::fromValue($password);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function verify(string $password): bool
    {
        return password_verify($password, $this->value());
    }

    /**
     * @param mixed $password
     * @return bool
     */
    public static function isValid($password): bool
    {
        $containsUpperCase  = preg_match('@[A-Z]@', $password);
        $containsLowerCase  = preg_match('@[a-z]@', $password);
        $containsNumber     = preg_match('@[0-9]@', $password);
        $passwordLongEnough = strlen($password) >= 10;
        return $containsUpperCase && $containsLowerCase && $containsNumber && $passwordLongEnough;
    }
}
