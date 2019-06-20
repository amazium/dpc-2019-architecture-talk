<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Address;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Address\ModifyAddressDetails as ModifyAddressDetailsCommand;
use Amazium\SampleApp\UI\Web\Form\Address\EditAddress as EditAddressForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Update extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $addressId = $request->getParsedBody()['address_id'] ?? null;
        if (empty($addressId)) {
            return new RedirectResponse('/address');
        }
        $form = EditAddressForm::create(
            sprintf('/address/%s/edit', $addressId)
        );
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = ModifyAddressDetailsCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['address_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/address/%s?msg=%s',
                        $result['address_id'],
                        'Address successfully modified!'
                    )
                );
            }
        }
        $handler->handle($request->withAttribute('editAddressForm', $form));
    }
}
