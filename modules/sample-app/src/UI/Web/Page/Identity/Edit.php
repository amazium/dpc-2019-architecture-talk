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
use Amazium\SampleApp\UI\Web\Form\Identity\EditIdentity as EditIdentityForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Edit extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return RedirectResponse|mixed|string
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $identityId = $request->getAttribute('identity_id') ?? null;
        if (empty($identityId)) {
            return new RedirectResponse('/identity');
        }
        $form = $request->getAttribute(
            'editIdentityForm',
            EditIdentityForm::create(
                sprintf('/identity/%s/edit', $identityId)
            )
        );

        /** @var IdentityDetailsQuery $identity */
        $identity = $this->fetch(IdentityDetailsQuery::fromArray([ 'identity_id' => $identityId ]));
        if (empty($identity)) {
            throw new LogicException('Identity not found!');
        }
        $form->setData($identity);
        return $this->render('sample-app::identity/edit', [ 'editIdentityForm' => $form ]);
    }
}
