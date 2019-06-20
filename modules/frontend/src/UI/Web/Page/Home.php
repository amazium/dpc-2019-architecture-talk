<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Frontend\UI\Web\Page;

use Amazium\Kernel\UI\Page\AbstractPage;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Home extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|string
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        return $this->render('frontend::home');
    }
}
