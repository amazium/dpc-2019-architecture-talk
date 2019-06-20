<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Frontend\UI\Web\Page;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Address\AddressDetails;
use Amazium\SampleApp\Domain\Aggregate\Address;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Amazium\SampleApp\Application\Command\Address\ModifyAddressDetails as ModifyAddressDetailsCommand;
use Amazium\SampleApp\UI\Web\Form\Address\EditAddress as EditAddressForm;
use Zend\Diactoros\Response\RedirectResponse;

class Page3 extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|string
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = EditAddressForm::create('/page/3');
        if ($request->getMethod() === 'GET') {
            /** @var Address $address */
            $address = $this->fetch(AddressDetails::fromArray($request->getQueryParams()));
            if (empty($address)) {
                throw new LogicException('Address not found!');
            }
            $form->setData($address->getArrayCopy());
            return $this->render(
                'frontend::page3',
                [
                    'editAddressForm' => $form
                ]
            );
        } else {
            $form->setData($request->getParsedBody());
            if ($form->isValid()) {
                $command = ModifyAddressDetailsCommand::fromArray($form->getData());
                $result = $this->execute($command);
                if ($result['address_id']) {
                    return new RedirectResponse(
                        '/page/1'
                    );
                }
            }
            die("IETS GING FOUT");
        }
    }
}
