<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Application\Message;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Domain\ValueObject\DateTime\DateTime;
use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Context\ContextArray;

class Message implements Extractable
{
    /**
     * @var Extractable
     */
    private $payload;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var MessageId
     */
    private $messageId;

    /**
     * @var DateTime
     */
    private $timestamp;

    /**
     * Message constructor.
     * @param Extractable $payload
     * @param Context|null $context
     * @param string|null $messageId
     * @param string $timestamp
     * @throws \Exception
     */
    public function __construct(
        Extractable $payload,
        Context $context = null,
        string $messageId = null,
        string $timestamp = 'now'
    ) {
        $this->payload = $payload;
        $this->context = $context ?: new ContextArray([]);
        $this->messageId = is_null($messageId) ? MessageId::generate() : MessageId::fromValue($messageId);
        $this->timestamp = DateTime::fromValue($timestamp);
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'message_id' => $this->messageId->scalar(),
            'timestamp'  => $this->timestamp->scalar(),
            'payload'    => $this->payload->getArrayCopy($options),
            'context'    => $this->context->getArrayCopy($options),
        ];
    }

    /**
     * @return mixed
     */
    public function payload()
    {
        return $this->payload;
    }

    /**
     * @return Context
     */
    public function context(): Context
    {
        return $this->context;
    }
}
