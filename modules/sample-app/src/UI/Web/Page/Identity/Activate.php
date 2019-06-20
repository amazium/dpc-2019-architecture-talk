<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Identity;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Identity\ActivateIdentity;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Activate extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return RedirectResponse|mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $identityId = $request->getAttribute('identity_id') ?? null;
        if (empty($identityId)) {
            return new RedirectResponse('/identity');
        }
        $this->execute(ActivateIdentity::fromArray([ 'identity_id' => $identityId ]));
        return new RedirectResponse(
            sprintf(
                '/identity?msg=%s',
                urlencode('Identity successfully activated')
            )
        );
    }
}
