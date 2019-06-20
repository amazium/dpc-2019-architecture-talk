<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\UI\Web\Page;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Identity\Domain\ValueObject\ExternalIdentifiers;
use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Omines\OAuth2\Client\Provider\Gitlab;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;

class LoginUsingGitlab extends AbstractPage
{
    /**
     * @var Gitlab
     */
    private $provider;

    /**
     * @var bool
     */
    protected $skipIfLoggedIn = true;

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|RedirectResponse
     * @throws IdentityProviderException
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        /** @var SessionInterface $session */
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if ($this->skipIfLoggedIn && $session->has(AuthenticatedUser::class)) {
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
            return new RedirectResponse($redirect);
        }

        $params = $request->getQueryParams();
        if (!isset($params['code'])) {
            return $this->redirectToAuthUrl($session);
        } elseif (empty($params['state']) || $params['state'] !== $session->get('oauth2state')) {
            $session->unset('oauth2state');
            throw new LogicException(sprintf('Invalid login state: ', $params['state'] ?? 'N/A'));
        }
        return $this->login($request, $handler);
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws IdentityProviderException
     */
    protected function login(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        // Get token
        $params = $request->getQueryParams();
        $token = $this->getProvider()->getAccessToken(
            'authorization_code',
            [
                'code' => $params['code'] ?? null,
            ]
        );
        $gitlabUserData = $this->getProvider()->getResourceOwner($token)->toArray();
        return $this->processGitlabUserData($request, $handler, $gitlabUserData);
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @param array $gitlabUserData
     * @return RedirectResponse
     */
    protected function processGitlabUserData(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler,
        array $gitlabUserData
    ) {
        $request = $request
            ->withAttribute(
                'authenticated_method',
                ExternalIdentifiers::SOURCE_GITLAB
            )
            ->withQueryParams([
                'gitlab_user_data' => $gitlabUserData,
            ]);
        $response = $handler->handle($request);
        if ($response->getStatusCode() !== 302) {
            return new RedirectResponse($this->getRedirect($request));
        }
        return $response;
    }

    /**
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    protected function redirectToAuthUrl(SessionInterface $session)
    {
        $authUrl = $this->getProvider()->getAuthorizationUrl();
        $session->set('oauth2state', $this->getProvider()->getState());
        return new RedirectResponse($authUrl);
    }

    /**
     * @return Gitlab
     */
    protected function getProvider(): Gitlab
    {
        if (empty($this->provider)) {
            $authentication = $this->config('authentication', []);
            $this->provider = new Gitlab($authentication[ExternalIdentifiers::SOURCE_GITLAB] ?? []);
        }
        return $this->provider;
    }

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
}
