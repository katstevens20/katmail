<?php

namespace kat;

use Kat\BatchFramework\Core\Config;
use Mailjet\Client;
use Mailjet\Resources;
use Exception;

class MailjetMailer extends AbstractKatMail implements KatMailInterface
{
    /**
     * @param string $mailjetKey
     * @return MailjetMailer
     */
    public function setMailjetKey(string $mailjetKey): MailjetMailer
    {
        $this->mailjetKey = $mailjetKey;
        return $this;
    }

    /**
     * @param string $mailjetSecret
     * @return MailjetMailer
     */
    public function setMailjetSecret(string $mailjetSecret): MailjetMailer
    {
        $this->mailjetSecret = $mailjetSecret;
        return $this;
    }
    private string $mailjetKey;
    private string $mailjetSecret;

    /**
     * @throws Exception
     */
    public function send(): ?bool
    {
        $appEnv = $this->appEnv;
        $this->mailClient = new Client($this->mailjetKey, $this->mailjetSecret, true, ['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => $this->emailSender,
                        'Name' => $this->appName
                    ],
                    'To' => [
                        [
                            'Email' => $this->emailReceiver,
                            'Name' => $this->emailReceiverName
                        ]
                    ],
                    'Subject' => $appEnv . ' ' . $this->mailSubject,
                    'TextPart' => '',
                    'HTMLPart' => $this->mailBody?:' ',
                    'Attachments' => $this->attachements
                ]
            ]
        ];
        $response = $this->mailClient->post(Resources::$Email, ['body' => $body]);
        if(!$response->success()) {
            throw new Exception($response->getBody()['Messages'][0]['Errors'][0]['ErrorMessage']);
        }
        return $response->success();
    }
}