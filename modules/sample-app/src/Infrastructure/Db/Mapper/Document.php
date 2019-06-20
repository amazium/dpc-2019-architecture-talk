<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Mapper;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Document as DocumentModel;

class Document
{
    /**
     * @param DocumentModel $document
     * @param Engine $engine
     * @return array
     */
    public static function documentModelToTableData(DocumentModel $document): array
    {
        $data = $document->getArrayCopy();
        if (isset($data['id'])) {
            unset($data['id']);
        }
        if (isset($data['document_id'])) {
            $data['id'] = $data['document_id'];
            unset($data['document_id']);
        }
        if (isset($data['extra_info'])) {
            $data['extra_info'] = json_encode($data['extra_info'], JSON_PRETTY_PRINT);
        }
        return $data;
    }

    /**
     * @param array $payload
     * @return DocumentModel
     * @throws \Exception
     */
    public static function tableDataToDocumentModel(array $payload): DocumentModel
    {
        if (isset($payload['id'])) {
            $payload['internal_id'] = $payload['id'];
            $payload['document_id'] = $payload['id'];
            unset($payload['id']);
        }
        if (isset($payload['extra_info'])) {
            $payload['extra_info'] = json_decode($payload['extra_info'], true);
        }
        return DocumentModel::fromArray($payload);
    }
}
