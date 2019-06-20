<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Card;

class CreateCard extends AbstractCardForm
{
    /**
     * @var bool
     */
    protected static $hasCardId = false;

    /**
     * @var bool
     */
    protected static $hasIdentityId = true;

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_edit_card';
    }
}
