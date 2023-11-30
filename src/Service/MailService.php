<?php


// src/Service/MailService.php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\User2Repository;




class MailService
{
    private $mailer;
    private $user2Repository;

    public function __construct(MailerInterface $mailer, User2Repository $user2Repository)
    {
        $this->mailer = $mailer;
        $this->user2Repository = $user2Repository;
    }

    public function sendCancellationEmailToAllUsers($eventName)
    {
        $allUserEmails = $this->getAllUserEmails();

        $email = (new Email())
            ->from('haithem.lahdhiri@esprit.tn')
            ->to(...$allUserEmails)
            ->subject('Annulation de l\'événement')
            ->text("L'événement \"$eventName\" a été annulé. Désolé pour le désagrément.");

        $this->mailer->send($email);
    }

    private function getAllUserEmails()
    {
        $users = $this->user2Repository->findAll();
        $userEmails = [];

        foreach ($users as $user) {
            $userEmails[] = $user->getMailuser();
        }

        return $userEmails;
    }
}