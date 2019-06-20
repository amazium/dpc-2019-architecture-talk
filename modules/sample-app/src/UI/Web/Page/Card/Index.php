<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Card;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Card\CardsForOverview as CardsForOverviewQuery;
use Amazium\SampleApp\UI\Web\Form\Card\CardOverviewFilter;
use Amazium\SampleApp\UI\Web\Table\CardOverview as CardOverviewTable;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Index extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|string
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = CardOverviewFilter::create('/card', 'GET');
        $form->setData($request->getQueryParams());
        if ($form->isValid()) {
            $search = CardsForOverviewQuery::fromArray($form->getData());
            $cardes = $this->fetch($search);
        }
        $overviewTable = CardOverviewTable::create($cardes ?? []);
        return $this->render(
            'sample-app::card/index',
            [
                'cardOverviewFilter' => $form,
                'cardOverviewTable' => $overviewTable,
            ]
        );
    }
}
