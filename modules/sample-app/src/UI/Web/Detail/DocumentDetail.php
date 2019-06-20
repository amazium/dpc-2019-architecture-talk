<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-02}
 */

namespace Amazium\SampleApp\UI\Web\Detail;

use Amazium\Kernel\UI\Web\Detail\Detail;
use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\FileType;

class DocumentDetail extends Detail
{
    /**
     * @return array
     */
    public function config(): array
    {
        return [
            'actions' => [
                'edit' => [
                    'id' => function ($data) {
                        return 'btn_edit_' . $data['document_id'];
                    },
                    'label' => 'Edit Document',
                    'icon'  => 'pencil-alt',
                    'action' => 'document.edit',
                    'action_params' => [
                        'document_id' => function ($data) {
                            return $data['document_id'];
                        }
                    ],
                ],
                'delete' => [
                    'id' => function ($data) {
                        return 'btn_destroy_' . $data['document_id'];
                    },
                    'label' => 'Delete Document',
                    'icon'  => 'trash-alt',
                    'action' => 'document.destroy',
                    'action_params' => [
                        'document_id' => function ($data) {
                            return $data['document_id'];
                        }
                    ],
                    'class' => 'btn-danger'
                ],
            ],
            'items' => [
                [
                    'label' => 'Identifier',
                    'key' => 'document_id',
                ],
                [
                    'label' => 'Identity',
                    'key' => 'identity_name',
                    'action' => 'identity.show',
                    'action_params' => [
                        'identity_id' => function ($data) {
                            return $data['identity_id'] ?? null;
                        },
                    ],
                ],
                [
                    'label' => 'Document Type',
                    'key' => 'document_type',
                    'value' => function ($data) {
                        return DocumentType::$types[$data['document_type']];
                    },
                ],
                [
                    'label' => 'Identifier',
                    'key' => 'document_identifier',
                ],
                [
                    'label' => 'File Type',
                    'key' => 'file_type',
                    'value' => function ($data) {
                        return FileType::$types[$data['file_type']];
                    },
                ],
                [
                    'label' => 'Valid From',
                    'key' => 'valid_from',
                ],
                [
                    'label' => 'Valid Until',
                    'key' => 'valid_until',
                ],
            ],
        ];
    }
}
