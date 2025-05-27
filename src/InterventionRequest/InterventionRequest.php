<?php

declare(strict_types=1);

namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration;
use AM\InterventionRequest\Encoder\ImageEncoderInterface;
use AM\InterventionRequest\FileResolverInterface;
use AM\InterventionRequest\InterventionRequest as BaseInterventionRequest;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class InterventionRequest extends BaseInterventionRequest
{
    /**
     * @param array<EventSubscriberInterface> $subscribers
     */
    public function __construct(
        Configuration $configuration,
        FileResolverInterface $fileResolver,
        ImageEncoderInterface $imageEncoder,
        array $subscribers,
        ?LoggerInterface $logger = null,
        ?array $processors = null,
        #[Autowire(param: 'kernel.debug')]
        bool $debug = false,
    ) {
        parent::__construct(
            $configuration,
            $fileResolver,
            $logger ?? new NullLogger(),
            $imageEncoder,
            $processors,
            $debug
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
