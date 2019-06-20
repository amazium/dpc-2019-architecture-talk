<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Document;

use Amazium\SampleApp\Domain\Repository\Document as DocumentRepository;
use Amazium\Kernel\Application\Message\Message;

abstract class AbstractDocumentHandler
{
    /**
     * @var DocumentRepository
     */
    protected $documents;

    /**
     * AbandonDocumentAbstractHandler constructor.
     * @param DocumentRepository $documents
     */
    public function __construct(DocumentRepository $documents)
    {
        $this->documents = $documents;
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function __invoke(Message $message)
    {
        return $this->handle($message->payload(), $message->context());
    }
}
