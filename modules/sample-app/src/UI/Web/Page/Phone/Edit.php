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
use Amazium\SampleApp\Application\Query\Phone\PhoneDetails;
use Amazium\SampleApp\UI\Web\Form\Phone\EditPhone as EditPhoneForm;
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
        $phoneId = $request->getAttribute('phone_id') ?? null;
        if (empty($phoneId)) {
            return new RedirectResponse('/phone');
        }
        $form = $request->getAttribute(
            'editPhoneForm',
            EditPhoneForm::create(
                sprintf('/phone/%s/edit', $phoneId)
            )
        );

        /** @var PhoneDetails $phone */
        $phone = $this->fetch(PhoneDetailsQuery::fromArray([ 'phone_id' => $phoneId ]));
        if (empty($phone)) {
            throw new LogicException('Phone not found!');
        }
        $form->setData($phone->getArrayCopy());
        return $this->render('sample-app::phone/edit', [ 'editPhoneForm' => $form ]);
    }
}
