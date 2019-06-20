<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Repository;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Document as DocumentModel;
use Amazium\SampleApp\Domain\ValueObject\DocumentId;
use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\Repository\Document as DocumentRepository;
use Amazium\SampleApp\Infrastructure\Db\Mapper\Document as DocumentMapper;

class Document implements DocumentRepository
{
    /**
     * @var Engine
     */
    private $dbEngine;

    /**
     * Document constructor.
     * @param Engine $dbEngine
     */
    public function __construct(Engine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param DocumentModel $document
     * @return bool
     */
    public function save(DocumentModel $document): bool
    {
        if ($document->getInternalId()) {
            return $this->dbEngine->update(
                'document',
                DocumentMapper::documentModelToTableData($document),
                [ 'id' => $document->getInternalId()->scalar() ]
            ) !== false;
        } else {
            return $this->dbEngine->insert(
                'document',
                DocumentMapper::documentModelToTableData($document)
            );
        }
    }

    /**
     * @param DocumentId $documentId
     * @return DocumentModel|null
     * @throws \Exception
     */
    public function findById(DocumentId $documentId): ?DocumentModel
    {
        $results = $this->dbEngine->find('document', [ 'id' => $documentId->scalar() ]);
        if (count($results) === 1) {
            return DocumentMapper::tableDataToDocumentModel($results[0]);
        }
        return null;
    }

    /**
     * @param DocumentId $documentId
     * @return array|null
     */
    public function fetchById(DocumentId $documentId): ?array
    {
        $results = $this->dbEngine->find('v_document_detail', [ 'id' => $documentId->scalar() ]);
        if (count($results) === 1) {
            return $results[0];
        }
        return null;
    }

    /**
     * @param DocumentId $documentId
     * @return bool
     */
    public function deleteById(DocumentId $documentId): bool
    {
        $where = [
            'document_id' => $documentId,
        ];
        return $this->dbEngine->delete('document', $where);
    }

    /**
     * @param DocumentType|null $documentType
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(?DocumentType $documentType, ?IdentityId $identityId): array
    {
        $where = [];
        if (!is_null($documentType)) {
            $where['document_type'] = $documentType->scalar();
        }
        if (!is_null($identityId)) {
            $where['identity_id'] = $identityId->scalar();
        }
        return $this->dbEngine->find(
            'v_document_overview',
            $where
        );
    }
}
