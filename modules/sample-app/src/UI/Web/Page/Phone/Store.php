<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Phone;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Phone\RegisterPhone as CreatePhoneCommand;
use Amazium\SampleApp\UI\Web\Form\Phone\CreatePhone as CreatePhoneForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Store extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = CreatePhoneForm::create('/phone/create');
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = CreatePhoneCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['phone_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/phone/%s?msg=%s',
                        $result['phone_id'],
                        'Phone successfully created!'
                    )
                );
            }
        }
        return $handler->handle($request->withAttribute('createPhoneForm', $form));
    }
}
