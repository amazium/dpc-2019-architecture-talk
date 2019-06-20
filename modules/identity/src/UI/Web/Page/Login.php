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

class Login extends AbstractPage
{
    private function getRedirect(ServerRequestInterface $request): string
    {
        $redirect = ($request->getQueryParams())['red'] ?? '';
        if (empty($redirect)) {
            $redirect = ($request->getQueryParams())['redirect'] ?? '';
        }
        if (empty($redirect)) {
            $redirect = ($request->getParsedBody())['redirect'] ?? '';
        }
        if (empty($redirect)) {
            $redirect = '/';
        }
        return $redirect;
    }

    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $redirect = $this->getRedirect($request);

        /** @var SessionInterface $session */
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if ($session->has(AuthenticatedUser::class)) {
            return new RedirectResponse($redirect);
        }

        // Set form params
        $params = [
            'redirect' => $redirect,
            'error' => '',
        ];

        // Process form posting
        if ($request->getMethod() === 'POST') {
            $body = $request->getParsedBody();
            $username = $body['username'] ?? null;
            $password = $body['password'] ?? null;
            if (!empty($username) && !empty($password)) {
                $request = $request->withAttribute('authenticated_method', 'username_password');
                $response = $handler->handle($request);
                if ($response->getStatusCode() !== 302) {
                    return new RedirectResponse($redirect);
                }
            }
            $params['error']    = 'Login Failure, please try again';
            $params['username'] = $username;
        }

        // Show login form
        return $this->render('identity::login', $params);
    }
}
