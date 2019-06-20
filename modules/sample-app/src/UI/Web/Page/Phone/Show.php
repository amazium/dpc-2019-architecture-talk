<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Phone;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Phone\PhoneDetails as PhoneDetailsQuery;
use Amazium\SampleApp\UI\Web\Detail\PhoneDetail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Show extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $phoneId = $request->getAttribute('phone_id') ?? null;
        if (empty($phoneId)) {
            return new RedirectResponse(
                sprintf(
                    '/phone?err=%s',
                    'Phone not found!'
                )
            );
        }

        /** @var PhoneDetailsQuery $phone */
        $phone = $this->fetch(PhoneDetailsQuery::fromArray([ 'phone_id' => $phoneId ]));
        if (empty($phone)) {
            throw new LogicException('Phone not found!');
        }
        $phoneDetail = PhoneDetail::create($phone->getArrayCopy());
        return $this->render(
            'sample-app::phone/show',
            [
                'phoneDetailData' => $phoneDetail
            ]
        );
    }
}
