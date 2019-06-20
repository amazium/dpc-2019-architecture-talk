<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Address;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Address\CreateAddress as CreateAddressCommand;
use Amazium\SampleApp\UI\Web\Form\Address\CreateAddress as CreateAddressForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Store extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = CreateAddressForm::create('/address/create');
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = CreateAddressCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['address_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/address/%s?msg=%s',
                        $result['address_id'],
                        'Address successfully created!'
                    )
                );
            }
        }
        return $handler->handle($request->withAttribute('createAddressForm', $form));
    }
}
