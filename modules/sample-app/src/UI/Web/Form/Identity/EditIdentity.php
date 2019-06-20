<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Form\Identity;

class EditIdentity extends AbstractIdentityForm
{
    /**
     * @var bool
     */
    protected static $hasIdentityId = true;

    /**
     * @return string
     */
    public static function name(): string
    {
        return 'frm_create_identity';
    }

}
