<?php

class MailSender {

    protected static $_transporter;

    public static function send($receivers, $subject, $body, $replyTo = null, $replyName = null) {
        $receivers = (array) $receivers;

        $transport = self::getTransport();

        $mailer = Swift_Mailer::newInstance($transport);

        $message = Swift_Message::newInstance($subject, $body);

        $numSent = 0;
        foreach ($receivers as $name => $email) {
            if (is_int($name)) {
                $message->setTo($email);
            } else {
                $message->setTo($email, $name);
            }

            if ($replyTo) {
                $message->setFrom($replyTo, $replyName);
            }

            $numSent += $mailer->send($message);
        }

        return $numSent;
    }

    /**
     * @return Swift_SmtpTransport
     */
    public static function getTransport() {
        if (self::$_transporter == null) {
            self::$_transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
                ->setUsername('tronghieu.luu@gmail.com')
                ->setPassword('thanhle85');
        }

        return self::$_transporter;
    }
}