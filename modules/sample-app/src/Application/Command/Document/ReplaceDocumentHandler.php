<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface ReplaceDocumentHandler extends CommandHandler
{
    /**
     * @param ReplaceDocument $replaceDocument
     * @param Context $context
     * @return array
     */
    public function handle(ReplaceDocument $replaceDocument, Context $context): array;
}
