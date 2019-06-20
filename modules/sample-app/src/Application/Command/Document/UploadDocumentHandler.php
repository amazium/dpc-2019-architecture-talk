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

interface UploadDocumentHandler extends CommandHandler
{
    /**
     * @param UploadDocument $uploadDocument
     * @param Context $context
     * @return array
     */
    public function handle(UploadDocument $uploadDocument, Context $context): array;
}
