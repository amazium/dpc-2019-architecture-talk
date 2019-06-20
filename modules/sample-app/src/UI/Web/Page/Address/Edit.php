<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Address;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Address\AddressDetails as AddressDetailsQuery;
use Amazium\SampleApp\Application\Query\Address\AddressDetails;
use Amazium\SampleApp\UI\Web\Form\Address\EditAddress as EditAddressForm;
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
        $addressId = $request->getAttribute('address_id') ?? null;
        if (empty($addressId)) {
            return new RedirectResponse('/address');
        }
        $form = $request->getAttribute(
            'editAddressForm',
            EditAddressForm::create(
                sprintf('/address/%s/edit', $addressId)
            )
        );

        /** @var AddressDetails $address */
        $address = $this->fetch(AddressDetailsQuery::fromArray([ 'address_id' => $addressId ]));
        if (empty($address)) {
            throw new LogicException('Address not found!');
        }
        $form->setData($address);
        return $this->render('sample-app::address/edit', [ 'editAddressForm' => $form ]);
    }
}
