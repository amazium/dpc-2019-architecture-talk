<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Identity;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Identity\IdentityDetails as IdentityDetailsQuery;
use Amazium\SampleApp\UI\Web\Detail\IdentityDetail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Show extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $identityId = $request->getAttribute('identity_id') ?? null;
        if (empty($identityId)) {
            return new RedirectResponse(
                sprintf(
                    '/identity?err=%s',
                    'Identity not found!'
                )
            );
        }

        /** @var IdentityDetailsQuery $identity */
        $identity = $this->fetch(IdentityDetailsQuery::fromArray([ 'identity_id' => $identityId ]));
        if (empty($identity)) {
            throw new LogicException('Identity not found!');
        }
        $identityDetail = IdentityDetail::create($identity);
        return $this->render(
            'sample-app::identity/show',
            [
                'identityDetailData' => $identityDetail
            ]
        );
    }
}
