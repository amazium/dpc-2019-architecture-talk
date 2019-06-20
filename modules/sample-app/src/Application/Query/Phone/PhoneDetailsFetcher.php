<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Query\QueryFetcher;

interface PhoneDetailsFetcher extends QueryFetcher
{
    /**
     * @param PhoneDetails $phoneDetails
     * @param Context $context
     * @return mixed
     */
    public function fetch(PhoneDetails $phoneDetails, Context $context);
}
