<?php

namespace App\Bundle;

use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Message\MessageInterface;

class Notification
{
    private $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    public function sendNotification(MessageInterface $notificationMessage)
    {
        // Logique pour envoyer la notification à tous les utilisateurs
        // Utilisez $this->notifier->send() pour envoyer la notification
    }
}