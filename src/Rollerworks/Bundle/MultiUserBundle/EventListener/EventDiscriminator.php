<?php

namespace Rollerworks\Bundle\MultiUserBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Rollerworks\Bundle\MultiUserBundle\Model\UserDiscriminatorInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventDiscriminator implements EventSubscriberInterface
{

    /**
     *
     * @var UserDiscriminatorInterface
     */
    private $userDiscriminator;

    /**
     *
     * @var EventDispatcherInterface
     */
    private $eventDisplatcher;

    /**
     * @param UserDiscriminatorInterface $userDiscriminator
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(UserDiscriminatorInterface $userDiscriminator, EventDispatcherInterface $eventDispatcher)
    {
        $this->userDiscriminator = $userDiscriminator;
        $this->eventDisplatcher = $eventDispatcher;
    }

    /**
     * Dispatchs discriminated event for current user system.
     * 
     * @param \Symfony\Component\EventDispatcher\Event $event
     */
    public function dispatchDiscriminatedEvent(Event $event)
    {
        $currentUserSystem = $this->userDiscriminator->getCurrentUser();
        $discriminatedEventName = $currentUserSystem . '.' . $event->getName();

        $this->eventDisplatcher->dispatch($discriminatedEventName, $event);
    }

    /**
     * 
     * Subscribes to all events defined in FOS\UserBundle\FOSUserEvents.
     * 
     * @return array
     */
    public static function getSubscribedEvents()
    {
        $eventsClass = new \ReflectionClass('FOS\UserBundle\FOSUserEvents');
        $events = $eventsClass->getConstants();

        $subscribedEvents = array_combine($events, array_fill(0, count($events), 'dispatchDiscriminatedEvent'));

        return $subscribedEvents;
    }

}