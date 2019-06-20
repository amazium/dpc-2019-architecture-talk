<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Phone;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\UI\Web\Form\Phone\CreatePhone as CreatePhoneForm;
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
        $form = $request->getAttribute('createPhoneForm');
        if (empty($form)) {
            $form = CreatePhoneForm::create('/phone/create');
            $form->setData([
                'phone_id' => $request->getQueryParams()['phone_id'] ?? null,
                'identity_id' => $request->getQueryParams()['identity_id'] ?? null,
            ]);
        }
        return $this->render(
            'sample-app::phone/create',
            [ 'createPhoneForm' => $form ]
        );
    }
}
