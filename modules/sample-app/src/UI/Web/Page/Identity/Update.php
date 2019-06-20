<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Identity;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Identity\ModifyIdentityDetails as ModifyIdentityDetailsCommand;
use Amazium\SampleApp\UI\Web\Form\Identity\EditIdentity as EditIdentityForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Update extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $identityId = $request->getParsedBody()['identity_id'] ?? null;
        if (empty($identityId)) {
            return new RedirectResponse('/identity');
        }
        $form = EditIdentityForm::create(
            sprintf('/identity/%s/edit', $identityId)
        );
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = ModifyIdentityDetailsCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['identity_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/identity/%s?msg=%s',
                        $result['identity_id'],
                        'Identity successfully modified!'
                    )
                );
            }
        }
        $handler->handle($request->withAttribute('editIdentityForm', $form));
    }
}
