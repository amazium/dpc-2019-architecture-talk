<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-29}
 */

namespace Amazium\Kernel\UI\Page;

use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Kernel\Application\Context\ApplicationContext;
use Amazium\Kernel\Application\Command\Command;
use Amazium\Kernel\Application\Message\Message;
use Amazium\Kernel\Application\Query\Query;
use League\Tactician\CommandBus;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Template\TemplateRendererInterface;

abstract class AbstractPage implements MiddlewareInterface
{
    /**
     * @var ApplicationContext
     */
    private $applicationContext;

    /**
     * @var TemplateRendererInterface
     */
    private $templateRenderer;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var CommandBus
     */
    private $queryBus;

    /**
     * @var array
     */
    private $config;

    /**
     * @var array
     */
    private $defaultParams = [];

    /**
     * AbstractPage constructor.
     * @param ApplicationContext $applicationContext
     * @param CommandBus $commandBus
     * @param CommandBus $queryBus
     * @param TemplateRendererInterface|null $templateRenderer
     * @param array $config
     */
    public function __construct(
        ApplicationContext $applicationContext,
        CommandBus $commandBus,
        CommandBus $queryBus,
        ?TemplateRendererInterface $templateRenderer,
        array $config
    ) {
        $this->applicationContext = $applicationContext;
        $this->commandBus = $commandBus;
        $this->queryBus   = $queryBus;
        $this->templateRenderer = $templateRenderer;
        $this->config = $config;
    }

    /**
     * @param $key
     * @param null $default
     * @return array
     */
    protected function config($key, $default = null): array
    {
        return $this->config[$key] ?? $default;
    }

    /**
     * @param Query $query
     * @return mixed
     * @throws \Exception
     */
    protected function fetch(Query $query)
    {
        return $this->queryBus->handle(new Message($query, $this->applicationContext));
    }

    /**
     * @param Command $command
     * @return mixed
     * @throws \Exception
     */
    protected function execute(Command $command)
    {
        return $this->commandBus->handle(new Message($command, $this->applicationContext));
    }

    /**
     * @param string $name
     * @param array $params
     * @return string
     */
    public function render(string $name, array $params = []): string
    {
        return $this->templateRenderer->render($name, $this->defaultParams + $params);
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed
     */
    abstract public function __invoke(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    );

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     * @throws \Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var ApplicationContext $applicationContext */
        $applicationContext = $request->getAttribute('application_context');
        if ($applicationContext->getAuthenticatedUser()) {
            $this->defaultParams['identity'] = $applicationContext->getAuthenticatedUser()->getDetails();
        }
        if ($request->getQueryParams()['msg'] ?? false) {
            $this->defaultParams['info_message'] = $request->getQueryParams()['msg'];
        }
        if ($request->getQueryParams()['err'] ?? false) {
            $this->defaultParams['error_message'] = $request->getQueryParams()['err'];
        }
        $result = $this($request, $handler);
        if ($result instanceof ResponseInterface) {
            return $result;
        } elseif (is_array($result)) {
            return new JsonResponse($result);
        } elseif (is_string($result)) {
            return new HtmlResponse($result);
        }
        throw new \Exception('Unknown result');
    }
}
