<?php
/**
 * Copyright (c) 2018. Rezo Zero
 *
 * Théâtre de la ville de Paris
 *
 * @file InterventionRequest.php
 * @author Ambroise Maupate <ambroise@rezo-zero.com>
 */

namespace RZ\InterventionRequestBundle\InterventionRequest;

use AM\InterventionRequest\Configuration;
use AM\InterventionRequest\InterventionRequest as BaseInterventionRequest;
use Psr\Log\LoggerInterface;

class InterventionRequest extends BaseInterventionRequest
{
    /**
     * @inheritDoc
     */
    public function __construct(Configuration $configuration, array $subscribers, LoggerInterface $logger = null, array $processors = null)
    {
        parent::__construct($configuration, $logger, $processors);

        foreach ($subscribers as $subscriber) {
            $class = $subscriber['class'];
            $constructArgs = $subscriber['args'];
            $refClass = new \ReflectionClass($class);
            $this->addSubscriber($refClass->newInstanceArgs($constructArgs));
        }
    }
}
