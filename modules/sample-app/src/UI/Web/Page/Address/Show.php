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
use Amazium\SampleApp\UI\Web\Detail\AddressDetail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Show extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $addressId = $request->getAttribute('address_id') ?? null;
        if (empty($addressId)) {
            return new RedirectResponse(
                sprintf(
                    '/address?err=%s',
                    'Address not found!'
                )
            );
        }

        /** @var AddressDetails $address */
        $address = $this->fetch(AddressDetailsQuery::fromArray([ 'address_id' => $addressId ]));
        if (empty($address)) {
            throw new LogicException('Address not found!');
        }
        $addressDetail = AddressDetail::create($address);
        return $this->render(
            'sample-app::address/show',
            [
                'addressDetailData' => $addressDetail
            ]
        );
    }
}
