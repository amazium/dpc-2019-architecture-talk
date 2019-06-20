<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Card;

class EditCard extends AbstractCardForm
{
    /**
     * @var bool
     */
    protected static $hasCardId = true;

    /**
     * @var bool
     */
    protected static $hasIdentityId = false;

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_edit_card';
    }
}
