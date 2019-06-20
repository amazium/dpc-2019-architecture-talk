<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Kernel\Application\Authentication;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Identity\Domain\ValueObject\ExternalIdentifiers;
use Amazium\Kernel\Core\Exception\LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Authentication\AuthenticationInterface;
use Zend\Expressive\Authentication\UserInterface;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;

class AmaziumSession implements AuthenticationInterface
{
    /**
     * @var AuthenticatedUserRepositoryInterface
     */
    private $repository;

    /**
     * @var array
     */
    private $config;

    /**
     * @var callable
     */
    private $responseFactory;

    /**
     * @var callable
     */
    private $userFactory;

    /**
     * AmaziumSession constructor.
     *
     * @param AuthenticatedUserRepositoryInterface $repository
     * @param array $config
     * @param callable $responseFactory
     * @param callable $userFactory
     */
    public function __construct(
        AuthenticatedUserRepositoryInterface $repository,
        array $config,
        callable $responseFactory,
        callable $userFactory
    ) {
        $this->repository = $repository;
        $this->config     = $config;

        // Ensures type safety of the composed factory
        $this->responseFactory = function () use ($responseFactory) : ResponseInterface {
            return $responseFactory();
        };

        // Ensures type safety of the composed factory
        $this->userFactory = function (
            string $identity,
            array $roles = [],
            array $details = []
        ) use ($userFactory) : AuthenticatedUser {
            return $userFactory($identity, $roles, $details);
        };
    }

    /**
     * @param ServerRequestInterface $request
     * @return AuthenticatedUser|null
     */
    protected function authenticateUsingRequest(ServerRequestInterface $request) : ?AuthenticatedUser
    {
        $authMethod = $request->getAttribute('authenticated_method');
        $params = $request->getQueryParams();
        switch ($authMethod) {
            case 'gitlab':
                return $this->repository->authenticateUsingExternalIdentifier(
                    ExternalIdentifiers::SOURCE_GITLAB,
                    $params['gitlab_user_data']['id']
                );
                break;

        }
        if ('POST' === strtoupper($request->getMethod())) {
            $params = $request->getParsedBody();
            if ($authMethod === 'username_password') {
                $username = $this->config['username'] ?? 'username';
                $password = $this->config['password'] ?? 'password';
                if (! isset($params[$username]) || ! isset($params[$password])) {
                    return null;
                }
                return $this->repository->authenticateUsingUsernameAndPassword(
                    $params[$username],
                    $params[$password]
                );
            }
        }
        return null;
    }

    /**
     * @param ServerRequestInterface $request
     * @return UserInterface|null
     */
    public function authenticate(ServerRequestInterface $request) : ?UserInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if (! $session) {
            throw new LogicException('Missing session container');
        }

        if ($session->has(UserInterface::class)) {
            return $this->createUserFromSession($session);
        }

        $user = $this->authenticateUsingRequest($request);
        if (null !== $user) {
            $session->set(AuthenticatedUser::class, $user->getArrayCopy());
            $session->regenerate();
        }
        return $user;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function unauthorizedResponse(ServerRequestInterface $request) : ResponseInterface
    {
        $redirect = $request->getQueryParams()['redirect'] ?? null;
        if (empty($redirect)) {
            $redirect = $request->getParsedBody()['redirect'] ?? null;
        }
        $redirectUrl = $this->config['redirect'] . ($redirect ? '?red=' . urlencode($redirect) : '');
        return ($this->responseFactory)()
            ->withHeader(
                'Location',
                $redirectUrl
            )
            ->withStatus(302);
    }

    /**
     * Create a UserInterface instance from the session data.
     *
     * zend-expressive-session does not serialize PHP objects directly. As such,
     * we need to create a UserInterface instance based on the data stored in
     * the session instead.
     *
     * @param SessionInterface $session
     * @return AuthenticatedUser|null
     */
    private function createUserFromSession(SessionInterface $session) : ?AuthenticatedUser
    {
        $userInfo = $session->get(AuthenticatedUser::class);
        if (!is_array($userInfo) || !isset($userInfo['identity'])) {
            return null;
        }
        $roles   = $userInfo['roles'] ?? [];
        $details = $userInfo['details'] ?? [];

        return ($this->userFactory)($userInfo['identity'], (array) $roles, (array) $details);
    }
}
