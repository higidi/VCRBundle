<?php

namespace VCR\VCRBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use VCR\VCREvents;
use VCR\Event\AfterHttpRequestEvent;

use VCR\VCRBundle\VCR\Logger;

class HttpRequestListener implements EventSubscriberInterface
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            VCREvents::VCR_AFTER_HTTP_REQUEST => 'onHttpRequest',
        );
    }

    public function onHttpRequest(AfterHttpRequestEvent $event)
    {
        $this->logger->logHttpRequest(
            $event->getRequest(),
            $event->getResponse()
        );
    }
}
