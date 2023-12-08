<?php

namespace App\Http\Controllers;
use App\DTO\Mail\SendMailDTO;
use Mail;

class MailController
{
    public function sendMail(SendMailDTO $sendMailDTO)
    {
        Mail::send(
            ['text' => $sendMailDTO->getBlade()],
            $sendMailDTO->getDataArray(),
            function ($message) use ($sendMailDTO)
            {
                $message->to($sendMailDTO->getTo(), $sendMailDTO->getSubjectTo())->subject($sendMailDTO->getSubject());
                $message->from($sendMailDTO->getFrom(), $sendMailDTO->getSubjectFrom());
            }
        );
    }

    public function LackOfActivity($last_activity, $to)
    {
        $sendMailDTO = new SendMailDTO(
            'mails/lack_of_activity',
            ['Last activity'=> $last_activity],
            $to,
            'ivanbazelian@gmail.com',
            'Recent activity',
            'User',
            'Laravel Blog'
        );
        $this->sendMail($sendMailDTO);
    }
}
