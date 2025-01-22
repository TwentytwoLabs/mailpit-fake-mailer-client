<?php

declare(strict_types=1);

namespace TwentytwoLabs\BehatFakeMailerExtension\Tests\Factory;

use TwentytwoLabs\BehatFakeMailerExtension\Factory\MailpitMailFactory;
use PHPUnit\Framework\TestCase;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Contact;
use TwentytwoLabs\BehatFakeMailerExtension\Model\Mail;

final class MailpitMailFactoryTest extends TestCase
{
    public function testShouldCreateMailWithName(): void
    {
        $data = [
            'ID' => '01948e2e-07fa-7b4c-bb8e-44c6a9df3dd1',
            'From' => ['Address' => 'no-reply@example.com', 'Name' => 'No Reply'],
            'To' => [
                ['Address' => 'john.doe@example.com', 'Name' => 'John Doe'],
            ],
            'Cc' => [
                ['Address' => 'jane.doe@example.com', 'Name' => 'Jane Doe'],
            ],
            'Bcc' => [
                ['Address' => 'support@example.com', 'Name' => 'Support'],
            ],
            'Subject' => 'Lorem ipsum',
            'Snippet' => 'Lorem ipsum',
        ];

        $mail = MailpitMailFactory::createMail($data);
        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame('01948e2e-07fa-7b4c-bb8e-44c6a9df3dd1', $mail->getMessageId());
        $sender = $mail->getSender();
        $this->assertInstanceOf(Contact::class, $sender);
        $this->assertSame('no-reply@example.com', $sender->getEmailAddress());
        $this->assertSame('No Reply', $sender->getName());
        $recipients = $mail->getRecipients();
        $this->assertCount(1, $recipients);
        $this->assertInstanceOf(Contact::class, $recipients[0]);
        $this->assertSame('john.doe@example.com', $recipients[0]->getEmailAddress());
        $this->assertSame('John Doe', $recipients[0]->getName());
        $ccRecipients = $mail->getCcRecipients();
        $this->assertCount(1, $ccRecipients);
        $this->assertInstanceOf(Contact::class, $ccRecipients[0]);
        $this->assertSame('jane.doe@example.com', $ccRecipients[0]->getEmailAddress());
        $this->assertSame('Jane Doe', $ccRecipients[0]->getName());
        $bccRecipients = $mail->getBccRecipients();
        $this->assertCount(1, $bccRecipients);
        $this->assertInstanceOf(Contact::class, $bccRecipients[0]);
        $this->assertSame('support@example.com', $bccRecipients[0]->getEmailAddress());
        $this->assertSame('Support', $bccRecipients[0]->getName());
        $this->assertSame('Lorem ipsum', $mail->getSubject());
        $this->assertSame('Lorem ipsum', $mail->getBody());
    }

    public function testShouldCreateMail(): void
    {
        $data = [
            'ID' => '01948e2e-07fa-7b4c-bb8e-44c6a9df3dd1',
            'From' => ['Address' => 'no-reply@example.com'],
            'To' => [['Address' => 'john.doe@example.com']],
            'Cc' => [['Address' => 'jane.doe@example.com']],
            'Bcc' => [['Address' => 'support@example.com']],
            'Subject' => 'Lorem ipsum',
            'Snippet' => 'Lorem ipsum',
        ];

        $mail = MailpitMailFactory::createMail($data);
        $this->assertInstanceOf(Mail::class, $mail);
        $this->assertSame('01948e2e-07fa-7b4c-bb8e-44c6a9df3dd1', $mail->getMessageId());
        $sender = $mail->getSender();
        $this->assertInstanceOf(Contact::class, $sender);
        $this->assertSame('no-reply@example.com', $sender->getEmailAddress());
        $this->assertNull($sender->getName());
        $recipients = $mail->getRecipients();
        $this->assertCount(1, $recipients);
        $this->assertInstanceOf(Contact::class, $recipients[0]);
        $this->assertSame('john.doe@example.com', $recipients[0]->getEmailAddress());
        $this->assertNull($recipients[0]->getName());
        $ccRecipients = $mail->getCcRecipients();
        $this->assertCount(1, $ccRecipients);
        $this->assertInstanceOf(Contact::class, $ccRecipients[0]);
        $this->assertSame('jane.doe@example.com', $ccRecipients[0]->getEmailAddress());
        $this->assertNull($ccRecipients[0]->getName());
        $bccRecipients = $mail->getBccRecipients();
        $this->assertCount(1, $bccRecipients);
        $this->assertInstanceOf(Contact::class, $bccRecipients[0]);
        $this->assertSame('support@example.com', $bccRecipients[0]->getEmailAddress());
        $this->assertNull($bccRecipients[0]->getName());
        $this->assertSame('Lorem ipsum', $mail->getSubject());
        $this->assertSame('Lorem ipsum', $mail->getBody());
    }
}
