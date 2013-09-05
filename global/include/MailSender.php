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
        $email_username = Setting::retrieveBySettingKey('email_username')->getSettingValue();
        $email_password = Setting::retrieveBySettingKey('email_password')->getSettingValue();
        $email_transport = Setting::retrieveBySettingKey('email_transport')->getSettingValue();

        if (self::$_transporter == null) {
            self::$_transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
                ->setUsername($email_username)
                ->setPassword($email_password);
        }

        return self::$_transporter;
    }
}