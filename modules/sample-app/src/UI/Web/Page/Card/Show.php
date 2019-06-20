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
use Amazium\SampleApp\UI\Web\Detail\CardDetail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Show extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $cardId = $request->getAttribute('card_id') ?? null;
        if (empty($cardId)) {
            return new RedirectResponse(
                sprintf(
                    '/card?err=%s',
                    'Card not found!'
                )
            );
        }

        /** @var CardDetailsQuery $card */
        $card = $this->fetch(CardDetailsQuery::fromArray([ 'card_id' => $cardId ]));
        if (empty($card)) {
            throw new LogicException('Card not found!');
        }
        $cardDetail = CardDetail::create($card->getArrayCopy());
        return $this->render(
            'sample-app::card/show',
            [
                'cardDetailData' => $cardDetail
            ]
        );
    }
}
