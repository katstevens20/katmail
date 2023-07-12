<?php

namespace kat;

use Mailjet\Client;
use Mailjet\Resources;
use Exception;

class MailjetMailer extends AbstractKatMail implements KatMailInterface
{

    /**
     * @throws Exception
     */
    public function send(): ?bool
    {
        $appEnv = $this->appEnv;

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