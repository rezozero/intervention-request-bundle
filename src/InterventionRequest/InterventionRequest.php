<?php
namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration;
use AM\InterventionRequest\InterventionRequest as BaseInterventionRequest;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InterventionRequest extends BaseInterventionRequest
{
    /**
     * @param Configuration  $configuration
     * @param array<EventSubscriberInterface> $subscribers
     * @param LoggerInterface|null $logger
     * @param array|null $processors
     *
     * @throws \RuntimeException
     */
    public function __construct(Configuration $configuration, array $subscribers, LoggerInterface $logger = null, array $processors = null)
    {
        parent::__construct(
            $configuration,
            $logger ?? new NullLogger(),
            $processors
        );

        foreach ($subscribers as $subscriber) {
            if ($subscriber instanceof EventSubscriberInterface) {
                $this->addSubscriber($subscriber);
            } else {
                throw new \RuntimeException(get_class($subscriber) . ' is not instance of ' . EventSubscriberInterface::class);
            }
        }
    }
}
