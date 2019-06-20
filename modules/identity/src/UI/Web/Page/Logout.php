<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\UI\Web\Page;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Kernel\UI\Page\AbstractPage;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Session\SessionMiddleware;

class Logout extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        // If we are already logged in, go to redirect page
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if ($session->has(AuthenticatedUser::class)) {
            $session->clear();
        }
        return new RedirectResponse('/');
    }
}
