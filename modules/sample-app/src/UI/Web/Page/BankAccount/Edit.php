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
use Amazium\SampleApp\Application\Query\BankAccount\BankAccountDetails;
use Amazium\SampleApp\UI\Web\Form\BankAccount\EditBankAccount as EditBankAccountForm;
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
        $bankAccountId = $request->getAttribute('bank_account_id') ?? null;
        if (empty($bankAccountId)) {
            return new RedirectResponse('/bank-account');
        }
        $form = $request->getAttribute(
            'editBankAccountForm',
            EditBankAccountForm::create(
                sprintf('/bank-account/%s/edit', $bankAccountId)
            )
        );

        /** @var BankAccountDetails $bankAccount */
        $bankAccount = $this->fetch(BankAccountDetailsQuery::fromArray([ 'bank_account_id' => $bankAccountId ]));
        if (empty($bankAccount)) {
            throw new LogicException('BankAccount not found!');
        }
        $form->setData($bankAccount);
        return $this->render('sample-app::bank-account/edit', [ 'editBankAccountForm' => $form ]);
    }
}
