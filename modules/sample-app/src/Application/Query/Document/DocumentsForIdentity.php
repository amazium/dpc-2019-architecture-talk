<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Document;

use Amazium\SampleApp\Domain\ValueObject\DocumentType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class DocumentsForIdentity extends DocumentsForOverview
{
    /**
     * DocumentsForIdentity constructor.
     * @param IdentityId $identityId
     * @param DocumentType|null $documentType
     */
    public function __construct(
        IdentityId $identityId,
        ?DocumentType $documentType = null
    ) {
        parent::__construct($documentType, $identityId);
    }
}
