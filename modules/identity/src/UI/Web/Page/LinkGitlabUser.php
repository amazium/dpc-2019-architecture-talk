<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\UI\Web\Page;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Identity\Domain\ValueObject\AccountExternalIdentifier\GitlabIdentifier;
use Amazium\Kernel\UI\Page\AbstractPage;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Session\SessionMiddleware;
use Amazium\Identity\Application\Command\Account\LinkGitlabUser as LinkGitlabUserCommand;

class LinkGitlabUser extends LoginUsingGitlab
{
    /**
     * @var bool
     */
    protected $skipIfLoggedIn = false;

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @param array $gitlabUserData
     * @return string|RedirectResponse
     * @throws \Exception
     */
    protected function processGitlabUserData(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler,
        array $gitlabUserData
    ) {
        $this->execute(LinkGitlabUserCommand::fromArray([ 'gitlab_identifier' => $gitlabUserData['id'] ]));
        return $this->render('identity::gitlab-user-linked', [ 'gitlab_user_data' => $gitlabUserData ]);
    }
}
