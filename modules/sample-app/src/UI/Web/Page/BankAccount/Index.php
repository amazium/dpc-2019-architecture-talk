<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\BankAccount;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountsForOverview as BankAccountsForOverviewQuery;
use Amazium\SampleApp\UI\Web\Form\BankAccount\BankAccountOverviewFilter;
use Amazium\SampleApp\UI\Web\Table\BankAccountOverview as BankAccountOverviewTable;
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
        $form = BankAccountOverviewFilter::create('/bank-account', 'GET');
        $form->setData($request->getQueryParams());
        if ($form->isValid()) {
            $search = BankAccountsForOverviewQuery::fromArray($form->getData());
            $bankAccounts = $this->fetch($search);
        }
        $overviewTable = BankAccountOverviewTable::create($bankAccounts ?? []);
        return $this->render(
            'sample-app::bank-account/index',
            [
                'bankAccountOverviewFilter' => $form,
                'bankAccountOverviewTable' => $overviewTable,
            ]
        );
    }
}
