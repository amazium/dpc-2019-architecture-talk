<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Address;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\UI\Web\Form\Address\CreateAddress as CreateAddressForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Create extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|string
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = $request->getAttribute('createAddressForm');
        if (empty($form)) {
            $form = CreateAddressForm::create('/address/create');
            $form->setData([
                'address_id' => $request->getQueryParams()['address_id'] ?? null,
                'identity_id' => $request->getQueryParams()['identity_id'] ?? null,
            ]);
        }
        return $this->render(
            'sample-app::address/create',
            [ 'createAddressForm' => $form ]
        );
    }
}
