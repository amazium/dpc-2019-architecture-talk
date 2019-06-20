<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Frontend\UI\Web\Page;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\UI\Web\Form\Address\CreateAddress as CreateAddressForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Form\FormInterface;
use Amazium\SampleApp\Application\Command\Address\CreateAddress as CreateAddressCommand;

class Page2 extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|string|RedirectResponse
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $post = array_merge(
            [
                'address_id' => $request->getQueryParams()['address_id'] ?? null,
                'identity_id' => $request->getQueryParams()['identity_id'] ?? null,
            ],
            $request->getParsedBody()
        );

        $form = CreateAddressForm::create('/page/2');
        $form->setData($post);
        if ($request->getMethod() === 'POST') {
            if ($form->isValid()) {
                $command = CreateAddressCommand::fromArray($form->getData());
                $result = $this->execute($command);
                if ($result['address_id']) {
                    return new RedirectResponse(
                        '/page/3?address_id=' . $result['address_id']
                    );
                }
            }
        }
        $params = [
            'createAddressForm' => $form,
        ];
        return $this->render('frontend::page2', $params);
    }
}
