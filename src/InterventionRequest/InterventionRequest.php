<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration;
use AM\InterventionRequest\FileResolverInterface;
use AM\InterventionRequest\InterventionRequest as BaseInterventionRequest;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InterventionRequest extends BaseInterventionRequest
{
    /**
     * @param array<EventSubscriberInterface> $subscribers
     */
    public function __construct(
        Configuration $configuration,
        FileResolverInterface $fileResolver,
        array $subscribers,
        ?LoggerInterface $logger = null,
        ?array $processors = null,
    ) {
        parent::__construct(
            $configuration,
            $fileResolver,
            $logger ?? new NullLogger(),
            $processors
        );

        foreach ($subscribers as $subscriber) {
            if ($subscriber instanceof EventSubscriberInterface) {
                $this->addSubscriber($subscriber);
            } else {
                throw new \RuntimeException(get_class($subscriber).' is not instance of '.EventSubscriberInterface::class);
            }
        }
    }
}
