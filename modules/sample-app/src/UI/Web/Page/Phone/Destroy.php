<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Phone;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Phone\AbandonPhone;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Destroy extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return RedirectResponse|mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $phoneId = $request->getAttribute('phone_id') ?? null;
        if (empty($phoneId)) {
            return new RedirectResponse('/phone');
        }
        $this->execute(AbandonPhone::fromArray([ 'phone_id' => $phoneId ]));
        return new RedirectResponse(
            sprintf(
                '/phone?msg=%s',
                urlencode('Phone successfully deleted')
            )
        );
    }
}
