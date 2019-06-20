<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Application\Command\Account;

use Amazium\Identity\Domain\Repository\Account as AccountRepository;
use Amazium\Kernel\Application\Context\ApplicationContext;
use Amazium\Kernel\Application\Message\Message;

abstract class LinkGitlabUserAbstractHandler implements LinkGitlabUserHandler
{
    /**
     * @var AccountRepository
     */
    protected $accounts;

    /**
     * RegisterUsingGitlabHandler constructor.
     * @param AccountRepository $accounts
     */
    public function __construct(AccountRepository $accounts)
    {
        $this->accounts = $accounts;
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function __invoke(Message $message)
    {
        return $this->handle($message->payload(), $message->context());
    }

    /**
     * @param LinkGitlabUser $command
     * @param ApplicationContext $context
     * @return array
     */
    abstract public function handle(LinkGitlabUser $command, ApplicationContext $context): array;

}
