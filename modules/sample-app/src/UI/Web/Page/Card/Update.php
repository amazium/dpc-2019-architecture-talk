<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Card;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Card\ModifyCardDetails as ModifyCardDetailsCommand;
use Amazium\SampleApp\UI\Web\Form\Card\EditCard as EditCardForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Update extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $cardId = $request->getParsedBody()['card_id'] ?? null;
        if (empty($cardId)) {
            return new RedirectResponse('/card');
        }
        $form = EditCardForm::create(
            sprintf('/card/%s/edit', $cardId)
        );
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = ModifyCardDetailsCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['card_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/card/%s?msg=%s',
                        $result['card_id'],
                        'Card successfully modified!'
                    )
                );
            }
        }
        $handler->handle($request->withAttribute('editCardForm', $form));
    }
}
