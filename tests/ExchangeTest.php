<?php

namespace tests;

use kat\ExchangeMailer;
use Snipworks\Smtp\Email;
use Mailjet\Client;
use PHPUnit\Framework\TestCase;

class ExchangeTest extends TestCase
{


    private string $mailReceiver = 'katlassi_ext@coyote-group.com';
    private string $mailSubject = '*Testcase: Send an email';
    private string $mailContent = <<<END
Hi,
this is a Testcase mail.
Testcase: Send an email
END;
    private $client = null;
    private $fileNamePath = 'README.md';
    private $downloadableFileName = 'afile.txt';


    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->exchangeMailer = new ExchangeMailer($this->client);
        $this->exchangeMailer
            ->setSmtpServer('smtp.coyote.local')
            ->setSmtpServerPort(25);

    }
/*
    public function testEmailSentWithEmptyBody()
    {
        $isSent = $this->exchangeMailer
            ->setEmailSender($this->mailReceiver)
            ->setEmailReceiver($this->mailReceiver)
            ->setMailSubject($this->mailSubject)
            ->setMailBody('')
            ->send();

        $this->assertTrue($isSent);
    }
*/
    public function testEmailSent()
    {
        $isSent = $this->exchangeMailer
            ->setAppEnv('INT')
            ->setEmailSender($this->mailReceiver)
            ->setEmailSenderName('Coyote')
            ->setEmailReceiver($this->mailReceiver)
            ->setEmailReceiverName('MR ATLASSI')
            ->setMailSubject($this->mailSubject)
            ->setMailBody('<pre>' . $this->mailContent . '</pre>')
            ->send();

        $this->assertTrue($isSent);
    }


    /**
     * @throws \Exception

    public function testEmailSentWithFile()
    {
        $isSent = $this->mailjetMailer
            ->setEmailSender($this->mailReceiver)
            ->setEmailReceiver($this->mailReceiver)
            ->setMailSubject($this->mailSubject . " - With file!")
            ->setMailBody($this->mailContent . " \nWith file!")
            ->setAttachements(json_decode('[{"ContentType":"text/plain","Filename":"' . $this->downloadableFileName . '","Base64Content":"' . base64_encode(file_get_contents($this->fileNamePath)) . '"}]', true))
            ->send();
        $this->assertTrue($isSent);
    }*/
}