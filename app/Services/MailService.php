<?php


namespace App\Services;


use Illuminate\Mail\Message;
use Mail;

class MailService
{
    /**
     * @param string $title 邮箱标题
     * @param string $content 邮箱内容
     * @param string $toMail 对方邮箱
     */
    public static function send ($title, $content, $toMail)  {
        Mail::raw(/**
         * @param $message
         */ $content, function (Message $message) use ($toMail, $title) {
            $message->subject($title);
            $message->to($toMail);
        });
    }
}