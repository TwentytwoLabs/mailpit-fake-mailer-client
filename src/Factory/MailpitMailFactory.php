<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Factory;

use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

class MailpitMailFactory
{
    /**
     * @param array<string, mixed> $data
     */
    public static function createMail(array $data): Mail
    {
        $mail = new Mail();
        $mail
            ->setMessageId($data['ID'])
            ->setSender(new Contact($data['From']['Address'], $data['From']['Name'] ?? null))
            ->setRecipients(array_map(
                fn (array $recipient) => new Contact($recipient['Address'], $recipient['Name'] ?? null),
                $data['To']
            ))
            ->setCcRecipients(array_map(
                fn (array $recipient) => new Contact($recipient['Address'], $recipient['Name'] ?? null),
                $data['Cc']
            ))
            ->setBccRecipients(array_map(
                fn (array $recipient) => new Contact($recipient['Address'], $recipient['Name'] ?? null),
                $data['Bcc']
            ))
            ->setSubject($data['Subject'])
            ->setBody($data['Snippet'])
        ;

        return $mail;
    }
}
