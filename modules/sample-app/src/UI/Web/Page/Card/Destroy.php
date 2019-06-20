<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Card;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\Card\AbandonCard;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Destroy extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return RedirectResponse|mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $cardId = $request->getAttribute('card_id') ?? null;
        if (empty($cardId)) {
            return new RedirectResponse('/card');
        }
        $this->execute(AbandonCard::fromArray([ 'card_id' => $cardId ]));
        return new RedirectResponse(
            sprintf(
                '/card?msg=%s',
                urlencode('Card successfully deleted')
            )
        );
    }
}
