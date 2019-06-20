<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Phone;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Phone\PhonesForOverview as PhonesForOverviewQuery;
use Amazium\SampleApp\UI\Web\Form\Phone\PhoneOverviewFilter;
use Amazium\SampleApp\UI\Web\Table\PhoneOverview as PhoneOverviewTable;
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
        $form = PhoneOverviewFilter::create('/phone', 'GET');
        $form->setData($request->getQueryParams());
        if ($form->isValid()) {
            $search = PhonesForOverviewQuery::fromArray($form->getData());
            $phonees = $this->fetch($search);
        }
        $overviewTable = PhoneOverviewTable::create($phonees ?? []);
        return $this->render(
            'sample-app::phone/index',
            [
                'phoneOverviewFilter' => $form,
                'phoneOverviewTable' => $overviewTable,
            ]
        );
    }
}
