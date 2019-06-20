<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\BankAccount;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\BankAccount\ModifyBankAccountDetails as ModifyBankAccountDetailsCommand;
use Amazium\SampleApp\UI\Web\Form\BankAccount\EditBankAccount as EditBankAccountForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Update extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $bankAccountId = $request->getParsedBody()['bank_account_id'] ?? null;
        if (empty($bankAccountId)) {
            return new RedirectResponse('/bank-account');
        }
        $form = EditBankAccountForm::create(
            sprintf('/bank-account/%s/edit', $bankAccountId)
        );
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = ModifyBankAccountDetailsCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['bank_account_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/bank-account/%s?msg=%s',
                        $result['bank_account_id'],
                        'BankAccount successfully modified!'
                    )
                );
            }
        }
        $handler->handle($request->withAttribute('editBankAccountForm', $form));
    }
}
