<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Address;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Address\AbandonAddress;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Destroy extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return RedirectResponse|mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $addressId = $request->getAttribute('address_id') ?? null;
        if (empty($addressId)) {
            return new RedirectResponse('/address');
        }
        $this->execute(AbandonAddress::fromArray([ 'address_id' => $addressId ]));
        return new RedirectResponse(
            sprintf(
                '/address?msg=%s',
                urlencode('Address successfully deleted')
            )
        );
    }
}
