<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\BankAccount;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\BankAccount\RequestBankAccount as CreateBankAccountCommand;
use Amazium\SampleApp\UI\Web\Form\BankAccount\CreateBankAccount as CreateBankAccountForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Store extends AbstractPage
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = CreateBankAccountForm::create('/bank-account/create');
        $form->setData($request->getParsedBody());
        if ($form->isValid()) {
            $command = CreateBankAccountCommand::fromArray($form->getData());
            $result = $this->execute($command);
            if ($result['bank_account_id']) {
                return new RedirectResponse(
                    sprintf(
                        '/bank-account/%s?msg=%s',
                        $result['bank_account_id'],
                        'BankAccount successfully created!'
                    )
                );
            }
        }
        return $handler->handle($request->withAttribute('createBankAccountForm', $form));
    }
}
