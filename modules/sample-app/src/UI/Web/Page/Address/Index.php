<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Address;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Address\AddressesForOverview as AddressesForOverviewQuery;
use Amazium\SampleApp\UI\Web\Form\Address\AddressOverviewFilter;
use Amazium\SampleApp\UI\Web\Table\AddressOverview as OverviewTable;
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
        $form = AddressOverviewFilter::create('/address', 'GET');
        $form->setData($request->getQueryParams());
        if ($form->isValid()) {
            $search = AddressesForOverviewQuery::fromArray($form->getData());
            $addresses = $this->fetch($search);
        }
        $overviewTable = OverviewTable::create($addresses ?? []);
        return $this->render(
            'sample-app::address/index',
            [
                'addressOverviewFilter' => $form,
                'addressOverviewTable' => $overviewTable,
            ]
        );
    }
}
