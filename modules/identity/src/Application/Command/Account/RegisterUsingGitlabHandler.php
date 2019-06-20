<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Kernel\Application\Context\ApplicationContext;

interface RegisterUsingGitlabHandler
{
    /**
     * @param RegisterUsingGitlab $registration
     * @param ApplicationContext $context
     * @return array
     */
    public function handle(RegisterUsingGitlab $registration, ApplicationContext $context): array;
}
