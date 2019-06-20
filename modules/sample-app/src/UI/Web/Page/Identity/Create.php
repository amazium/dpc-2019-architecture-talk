<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Identity;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\UI\Web\Form\Identity\CreateIdentity as CreateIdentityForm;
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
        $form = $request->getAttribute('createIdentityForm');
        if (empty($form)) {
            $form = CreateIdentityForm::create('/identity/create');
            $form->setData([
                'identity_id' => $request->getQueryParams()['identity_id'] ?? null,
            ]);
        }
        return $this->render(
            'sample-app::identity/create',
            [ 'createIdentityForm' => $form ]
        );
    }
}
