<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\Kernel\Application\Message\Message;
use Amazium\SampleApp\Domain\Repository\Document as DocumentRepository;

abstract class AbstractDocumentFetcher
{
    /**
     * @var DocumentRepository
     */
    protected $documents;

    /**
     * DocumentDetailsAbstractFetcher constructor.
     * @param DocumentRepository $documents
     */
    public function __construct(DocumentRepository $documents)
    {
        $this->documents = $documents;
    }

    /**
     * @param Message $queryMessage
     * @return mixed
     */
    public function __invoke(Message $queryMessage)
    {
        return $this->fetch($queryMessage->payload(), $queryMessage->context());
    }
}
