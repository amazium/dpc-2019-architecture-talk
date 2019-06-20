<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\BankAccount;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountDetails as BankAccountDetailsQuery;
use Amazium\SampleApp\UI\Web\Detail\BankAccountDetail;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Show extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $bankAccountId = $request->getAttribute('bank_account_id') ?? null;
        if (empty($bankAccountId)) {
            return new RedirectResponse(
                sprintf(
                    '/bank-account?err=%s',
                    'BankAccount not found!'
                )
            );
        }

        /** @var BankAccountDetailsQuery $bankAccount */
        $bankAccount = $this->fetch(BankAccountDetailsQuery::fromArray([ 'bank_account_id' => $bankAccountId ]));
        if (empty($bankAccount)) {
            throw new LogicException('BankAccount not found!');
        }
        $bankAccountDetail = BankAccountDetail::create($bankAccount);
        return $this->render(
            'sample-app::bank-account/show',
            [
                'bankAccountDetailData' => $bankAccountDetail
            ]
        );
    }
}
