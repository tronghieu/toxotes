<?php

class MailSender {
    protected static $_mailer;

    public static function send($receivers, $subject, $body, $replyTo = null, $replyName = null) {
        $receivers = (array) $receivers;

        $mailer = self::getMailer();
        foreach ($receivers as $name => $address) {
            if (is_int($name)) {
                $mailer->AddAddress($address);
            } else {
                $mailer->AddAddress($address, $name);
            }
        }

        if ($replyTo) {
            $mailer->AddReplyTo($replyTo, $replyName);
        }

        $mailer->Subject = $subject;
        $mailer->MsgHTML($body);
        if ($mailer->Send()) {
            return true;
        }

        $mailer->ClearReplyTos();
        $mailer->ClearAddresses();
        return false;
    }

    /**
     * @return PHPMailer
     */
    public static function getMailer() {
        if(self::$_mailer == null) {
            self::$_mailer = new PHPMailer(true);
        }

        return self::$_mailer;
    }
}