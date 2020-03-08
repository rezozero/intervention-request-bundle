<?php
namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration;
use AM\InterventionRequest\InterventionRequest as BaseInterventionRequest;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InterventionRequest extends BaseInterventionRequest
{
    /**
     * @inheritDoc
     * @throws \ReflectionException
     */
    public function __construct(Configuration $configuration, array $subscribers, LoggerInterface $logger = null, array $processors = null)
    {
        parent::__construct($configuration, $logger, $processors);

        foreach ($subscribers as $subscriber) {
            $class = $subscriber['class'];
            $constructArgs = $subscriber['args'];
            $refClass = new \ReflectionClass($class);
            $subscriberInstance = $refClass->newInstanceArgs($constructArgs);
            if ($subscriberInstance instanceof EventSubscriberInterface) {
                $this->addSubscriber($subscriberInstance);
            }
        }
    }
}
