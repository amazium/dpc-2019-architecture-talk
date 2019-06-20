<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Page\BankAccount;

use Amazium\Kernel\UI\Page\AbstractPage;
use Amazium\SampleApp\Application\Command\BankAccount\ActivateBankAccount;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

class Activate extends AbstractPage
{
    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return RedirectResponse|mixed
     * @throws \Exception
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler)
    {
        $bankAccountId = $request->getAttribute('bank_account_id') ?? null;
        if (empty($bankAccountId)) {
            return new RedirectResponse('/bank-account');
        }
        $this->execute(ActivateBankAccount::fromArray([ 'bank_account_id' => $bankAccountId ]));
        return new RedirectResponse(
            sprintf(
                '/bank-account?msg=%s',
                urlencode('BankAccount successfully activated')
            )
        );
    }
}
