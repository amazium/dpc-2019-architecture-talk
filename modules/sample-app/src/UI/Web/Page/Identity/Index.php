<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\Identity;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\Identity\IdentitiesForOverview as IdentitiesForOverviewQuery;
use Amazium\SampleApp\UI\Web\Form\Identity\IdentityOverviewFilter;
use Amazium\SampleApp\UI\Web\Table\IdentityOverview as IdentityOverviewTable;
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
        $form = IdentityOverviewFilter::create('/identity', 'GET');
        $form->setData($request->getQueryParams());
        if ($form->isValid()) {
            $search = IdentitiesForOverviewQuery::fromArray($form->getData());
            $identityes = $this->fetch($search);
        }
        $overviewTable = IdentityOverviewTable::create($identityes ?? []);
        return $this->render(
            'sample-app::identity/index',
            [
                'identityOverviewFilter' => $form,
                'identityOverviewTable' => $overviewTable,
            ]
        );
    }
}
