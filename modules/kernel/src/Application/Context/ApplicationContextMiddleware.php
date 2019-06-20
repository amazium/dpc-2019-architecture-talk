<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Kernel\Application\Context;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ApplicationContextMiddleware implements MiddlewareInterface
{
    /** @var ApplicationContext */
    private $applicationContext;

    /**
     * ApplicationContextMiddleware constructor.
     * @param ApplicationContext $applicationContext
     */
    public function __construct(ApplicationContext $applicationContext)
    {
        $this->applicationContext = $applicationContext;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request->withAttribute('application_context', $this->applicationContext));
    }
}
