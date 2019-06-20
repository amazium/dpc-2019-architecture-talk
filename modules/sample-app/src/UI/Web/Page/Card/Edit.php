<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Card;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Card\CardDetails as CardDetailsQuery;
use Amazium\SampleApp\Application\Query\Card\CardDetails;
use Amazium\SampleApp\UI\Web\Form\Card\EditCard as EditCardForm;
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
        $cardId = $request->getAttribute('card_id') ?? null;
        if (empty($cardId)) {
            return new RedirectResponse('/card');
        }
        $form = $request->getAttribute(
            'editCardForm',
            EditCardForm::create(
                sprintf('/card/%s/edit', $cardId)
            )
        );

        /** @var CardDetails $card */
        $card = $this->fetch(CardDetailsQuery::fromArray([ 'card_id' => $cardId ]));
        if (empty($card)) {
            throw new LogicException('Card not found!');
        }
        $form->setData($card->getArrayCopy());
        return $this->render('sample-app::card/edit', [ 'editCardForm' => $form ]);
    }
}
