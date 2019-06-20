<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Identity;

class CreateIdentity extends AbstractIdentityForm
{
    /**
     * @var bool
     */
    protected static $hasIdentityId = false;

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_edit_identity';
    }
}
