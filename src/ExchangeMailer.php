<?php

namespace kat;

use Exception;
use Snipworks\Smtp\Email;

class ExchangeMailer extends AbstractKatMail implements KatMailInterface
{
    private $smtpServer = '';
    private $smtpServerPort = '';

    /**
     * @param string $smtpServer
     * @return ExchangeMailer
     */
    public function setSmtpServer(string $smtpServer): ExchangeMailer
    {
        $this->smtpServer = $smtpServer;
        return $this;
    }

    /**
     * @param string $smtpServerPort
     * @return ExchangeMailer
     */
    public function setSmtpServerPort(string $smtpServerPort): ExchangeMailer
    {
        $this->smtpServerPort = $smtpServerPort;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function send(): ?bool
    {
        $this->mailClient = new Email( $this->smtpServer,  $this->smtpServerPort);

        $this->mailClient->addTo($this->emailReceiver, $this->emailReceiverName);
        $this->mailClient->setFrom($this->emailSender, $this->emailSenderName);
        $this->mailClient->setSubject(($this->appEnv == ''?:'[' . $this->appEnv . '] ') . $this->mailSubject);
        $this->mailClient->setHtmlMessage($this->mailBody);

        $isMailSent = $this->mailClient->send();
        var_dump($isMailSent);
        /*if (!$isMailSent) {
           //throw new Exception($this->mailClient->getLogs());
           throw new Exception('Email not sent');
        }*/
        return $isMailSent;
    }


}