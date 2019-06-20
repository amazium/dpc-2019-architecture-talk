<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\BankAccount;

class EditBankAccount extends AbstractBankAccountForm
{
    /**
     * @var bool
     */
    protected static $hasBankAccountId = true;

    /**
     * @var bool
     */
    protected static $hasIdentityId = false;

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_edit_bank_account';
    }
}
