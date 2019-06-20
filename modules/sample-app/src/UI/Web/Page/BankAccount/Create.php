<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\BankAccount;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\UI\Web\Form\BankAccount\CreateBankAccount as CreateBankAccountForm;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Create extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return mixed|string
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $form = $request->getAttribute('createBankAccountForm');
        if (empty($form)) {
            $form = CreateBankAccountForm::create('/bank-account/create');
            $form->setData([
                'bank_account_id' => $request->getQueryParams()['bank_account_id'] ?? null,
                'identity_id' => $request->getQueryParams()['identity_id'] ?? null,
            ]);
        }
        return $this->render(
            'sample-app::bank-account/create',
            [ 'createBankAccountForm' => $form ]
        );
    }
}
