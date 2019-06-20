<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Card;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Card\RegisterCard as CreateCardCommand;
use Amazium\SampleApp\UI\Web\Form\Card\CreateCard as CreateCardForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Store extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = CreateCardForm::create('/card/create');
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = CreateCardCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['card_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/card/%s?msg=%s',
                        $result['card_id'],
                        'Card successfully created!'
                    )
                );
            }
        }
        return $handler->handle($request->withAttribute('createCardForm', $form));
    }
}
