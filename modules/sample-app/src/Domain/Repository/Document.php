<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Repository;

use Amazium\Kernel\Domain\Repository\Repository;
use Amazium\SampleApp\Domain\Aggregate\Document as DocumentModel;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;
use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

interface Document extends Repository
{
    /**
     * @param DocumentModel $document
     * @return bool
     */
    public function save(DocumentModel $document): bool;

    /**
     * @param DocumentId $documentId
     * @return bool
     */
    public function deletById(DocumentId $documentId): bool;

    /**
     * @param DocumentId $documentId
     * @return DocumentModel|null
     */
    public function findById(DocumentId $documentId): ?DocumentModel;

    /**
     * @param DocumentId $documentId
     * @return array|null
     */
    public function fetchById(DocumentId $documentId): ?array;

    /**
     * @param DocumentType|null $documentType
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(
        ?DocumentType $documentType,
        ?IdentityId $identityId
    ): array;
}
