<?php

namespace kat;

use Exception;
use Snipworks\Smtp\Email;

class ExchangeMailer extends AbstractKatMail implements KatMailInterface
{
    private $smtpServer = '';
    private $smtpServerPort = '';
    private $emailSenderPassword = '';

    /**
     * @param string $emailSenderPassword
     * @return ExchangeMailer
     */
    public function setEmailSenderPassword(string $emailSenderPassword): ExchangeMailer
    {
        $this->emailSenderPassword = $emailSenderPassword;
        return $this;
    }

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
        $this->mailClient->setLogin($this->emailSender, $this->emailSenderPassword);
        $this->mailClient->addTo($this->emailReceiver, $this->emailReceiverName);
        $this->mailClient->setFrom($this->emailSender, $this->emailSenderName);
        $this->mailClient->setSubject(($this->appEnv == ''?:'[' . $this->appEnv . '] ') . $this->mailSubject);
        $this->mailClient->setHtmlMessage($this->mailBody);

        $isMailSent = $this->mailClient->send();

        if (!$isMailSent) {
            throw new Exception('Email not sent >> ' . print_r($this->mailClient->getLogs(), true));
        }
        return $isMailSent;
    }


}