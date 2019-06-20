<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Card;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\UI\Web\Form\Card\CreateCard as CreateCardForm;
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
        $form = $request->getAttribute('createCardForm');
        if (empty($form)) {
            $form = CreateCardForm::create('/card/create');
            $form->setData([
                'card_id' => $request->getQueryParams()['card_id'] ?? null,
                'identity_id' => $request->getQueryParams()['identity_id'] ?? null,
            ]);
        }
        return $this->render(
            'sample-app::card/create',
            [ 'createCardForm' => $form ]
        );
    }
}
