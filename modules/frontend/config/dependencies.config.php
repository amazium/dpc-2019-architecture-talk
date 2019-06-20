<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Frontend;

use Amazium\Frontend\UI\Web\Page\Home;
use Amazium\Frontend\UI\Web\Page\Page1;
use Amazium\Frontend\UI\Web\Page\Page2;
use Amazium\Frontend\UI\Web\Page\Page3;
use Amazium\Kernel\UI\Page\PageFactory;

return [
    'factories' => [
        Home::class => PageFactory::class,
        Page1::class => PageFactory::class,
        Page2::class => PageFactory::class,
        Page3::class => PageFactory::class,
    ],
];
