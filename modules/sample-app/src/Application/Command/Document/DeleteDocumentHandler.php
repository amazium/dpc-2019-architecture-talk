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

interface DeleteDocumentHandler extends CommandHandler
{
    /**
     * @param DeleteDocument $deleteDocument
     * @param Context $context
     * @return array
     */
    public function handle(DeleteDocument $deleteDocument, Context $context): array;
}
