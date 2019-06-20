<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Phone;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Phone\ModifyPhoneDetails as ModifyPhoneDetailsCommand;
use Amazium\SampleApp\UI\Web\Form\Phone\EditPhone as EditPhoneForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Update extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $phoneId = $request->getParsedBody()['phone_id'] ?? null;
        if (empty($phoneId)) {
            return new RedirectResponse('/phone');
        }
        $form = EditPhoneForm::create(
            sprintf('/phone/%s/edit', $phoneId)
        );
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = ModifyPhoneDetailsCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['phone_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/phone/%s?msg=%s',
                        $result['phone_id'],
                        'Phone successfully modified!'
                    )
                );
            }
        }
        $handler->handle($request->withAttribute('editPhoneForm', $form));
    }
}
