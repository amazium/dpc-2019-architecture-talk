<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Identity;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Identity\CreateIdentity as CreateIdentityCommand;
use Amazium\SampleApp\UI\Web\Form\Identity\CreateIdentity as CreateIdentityForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Store extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = CreateIdentityForm::create('/identity/create');
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = CreateIdentityCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['identity_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/identity/%s?msg=%s',
                        $result['identity_id'],
                        'Identity successfully created!'
                    )
                );
            }
        }
        return $handler->handle($request->withAttribute('createIdentityForm', $form));
    }
}
