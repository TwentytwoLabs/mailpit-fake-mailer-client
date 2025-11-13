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
            ->setSender(self::buildContact($data['From']))
            ->setRecipients(array_map(fn (array $recipient) => self::buildContact($recipient), $data['To'] ?? []))
            ->setCcRecipients(array_map(fn (array $recipient) => self::buildContact($recipient), $data['Cc'] ?? []))
            ->setBccRecipients(array_map(fn (array $recipient) => self::buildContact($recipient), $data['Bcc'] ?? []))
            ->setSubject($data['Subject'])
            ->setBody($data['Snippet'])
        ;

        return $mail;
    }

    private static function buildContact(array $data): Contact
    {
        return new Contact($data['Address'], empty($data['Name']) ? null : $data['Name']);
    }
}
