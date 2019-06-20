<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Phone;

class CreatePhone extends AbstractPhoneForm
{
    /**
     * @var bool
     */
    protected static $hasPhoneId = false;

    /**
     * @var bool
     */
    protected static $hasIdentityId = true;

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_edit_phone';
    }
}
