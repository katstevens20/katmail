<?php

namespace kat;

class AbstractKatMail
{

    protected  $mailClient;
    protected $mailSubject = "No subject";
    protected $mailBody = "Empty email";
    protected $emailSender = "";
    protected $emailSenderName = "No name";
    protected $emailReceiver = "";
    protected $emailReceiverName = "No name";
    protected $attachements = [];
    protected $appEnv = '';

    /**
     * @param string $appEnv
     * @return KatMailInterface
     */
    public function setAppEnv(string $appEnv): KatMailInterface
    {
        $this->appEnv = $appEnv;
        return $this;
    }

    /**
     * @param string $appName
     * @return KatMailInterface
     */
    public function setAppName(string $appName): KatMailInterface
    {
        $this->appName = $appName;
        return $this;
    }
    protected $appName = 'No name';

    /**
     * @param $mailClient
     * @return KatMailInterface
     */
    public function setMailClient($mailClient): KatMailInterface
    {
        $this->mailClient = $mailClient;
        return $this;
    }

    /**
     * @param string $mailSubject
     * @return KatMailInterface
     */
    public function setMailSubject(string $mailSubject): KatMailInterface
    {
        $this->mailSubject = $mailSubject;
        return $this;
    }

    /**
     * @param string $mailBody
     * @return KatMailInterface
     */
    public function setMailBody(string $mailBody): KatMailInterface
    {
        $this->mailBody = $mailBody;
        return $this;
    }

    /**
     * @param string $emailSender
     * @return KatMailInterface
     */
    public function setEmailSender(string $emailSender): KatMailInterface
    {
        $this->emailSender = $emailSender;
        return $this;
    }

    /**
     * @param string $emailSenderName
     * @return KatMailInterface
     */
    public function setEmailSenderName(string $emailSenderName): KatMailInterface
    {
        $this->emailSenderName = $emailSenderName;
        return $this;
    }

    /**
     * @param string $emailReceiver
     * @return KatMailInterface
     */
    public function setEmailReceiver(string $emailReceiver): KatMailInterface
    {
        $this->emailReceiver = $emailReceiver;
        return $this;
    }

    /**
     * @param string $emailReceiverName
     * @return KatMailInterface
     */
    public function setEmailReceiverName(string $emailReceiverName): KatMailInterface
    {
        $this->emailReceiverName = $emailReceiverName;
        return $this;
    }

    /**
     * @param null $attachements
     */
    public function setAttachements($attachements): KatMailInterface
    {
        $this->attachements = $attachements;
        return $this;
    }

}