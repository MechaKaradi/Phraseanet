<?php

/*
 * This file is part of phrasea-4.0.
 *
 * (c) Alchemy <info@alchemy.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Alchemy\Phrasea\Core\Event\Subscriber;

use Alchemy\Phrasea\Application;
use Alchemy\Phrasea\Core\Event\User\CreatedEvent;
use Alchemy\Phrasea\Core\Event\User\DeletedEvent;
use Alchemy\Phrasea\Core\Event\User\UserEvents;
use Alchemy\Phrasea\Model\Entities\WebhookEvent;
use Alchemy\Phrasea\Model\Manipulator\WebhookEventManipulator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class WebhookUserEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @var WebhookEventManipulator
     */
    private $manipulator;

    /**
     * @param Application $application
     */
    public function __construct(Application $application)
    {
        $this->app = $application;
        // manipulator.webhook-event is not set if phraseanet config is not set
        $this->manipulator = isset($this->app['manipulator.webhook-event']) ? $this->app['manipulator.webhook-event'] : null;
    }

    /**
     * @param DeletedEvent $event
     */
    public function onUserDeleted(DeletedEvent $event)
    {
        if ($this->manipulator !== null ) {
            $this->manipulator->create(WebhookEvent::USER_DELETED, WebhookEvent::USER_TYPE, [
                'user_id' => $event->getUserId(),
                'email' => $event->getEmailAddress(),
                'login' => $event->getLogin()
            ], $event->getGrantedBaseIds());
        }
    }

    public function onUserCreated(CreatedEvent $event)
    {
        if ($this->manipulator !== null ) {
            $user = $event->getUser();
            $this->manipulator->create(WebhookEvent::USER_CREATED, WebhookEvent::USER_TYPE, [
                'user_id' => $user->getId(),
                'email' => $user->getEmail(),
                'login' => $user->getLogin()
            ], []);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            UserEvents::DELETED => 'onUserDeleted',
            UserEvents::CREATED => 'onUserCreated'
        ];
    }
}
