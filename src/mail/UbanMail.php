<?php

namespace uban\mail;

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use think\Db;
use think\facade\Cache;

class UbanMail
{
    public static function sendMailByUser($user, $title, $message, $address)
    {
        $userConfig = Db::name('user_email_config')->find($user->getId());
        $ubanConfig = new UbanMailConfig();
        $ubanConfig->setConfig($userConfig['host'], $user->getEmail(), $userConfig['from_name'],
            $userConfig['password'], $userConfig['port'], $user->getEmail());

        return self::sendMail($ubanConfig, $title, $message, $address);
    }

    /**
     *
     * @param $config UbanMailConfig
     * @param $title
     * @param $html
     * @param $emailAddress
     * @return bool|string
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public static function sendMail($config, $title, $html, $emailAddress)
    {
        $mail = new PHPMailer();
        //3.设置属性，告诉我们的服务器，谁跟谁发送邮件
        $mail->IsSMTP();            //告诉服务器使用smtp协议发送
        $mail->SMTPAuth = true;        //开启SMTP授权
        $mail->Host = $config->getHost();    //告诉我们的服务器使用163的smtp服务器发送
        $mail->Port = $config->getPort();
        $mail->SMTPSecure = 'ssl';
        $mail->From = $config->getFrom();    //发送者的邮件地址
        $mail->FromName = $config->getFromName();        //发送邮件的用户昵称
        $mail->Username = $config->getUsername();    //登录到邮箱的用户名
        $mail->Password = $config->getPassword();        //第三方登录的授权码，在邮箱里面设置
        //编辑发送的邮件内容
        $mail->IsHTML(true);            //发送的内容使用html编写
        $mail->CharSet = 'utf-8';        //设置发送内容的编码
        $mail->Subject = $title;//设置邮件的标题
        $mail->SMTPOptions=[
            'ssl'=>[
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        $mail->MsgHTML($html);    //发送的邮件内容主体
        if (is_array($emailAddress)) {
            foreach ($emailAddress as $address) {
                $mail->addAddress($address);
            }
        } else {
            $mail->addAddress($emailAddress);    //收人的邮件地址
        }
        $result = $mail->Send();
        if ($result) {
            return true;
        } else {
            return $mail->ErrorInfo;
        }
    }

    public static function backSendByRedis($path, $config, $title, $html, $emailAddress,$redis_id)
    {
        $data['config'] = $config;
        $data['title'] = $title;
        $data['html'] = $html;
        $data['emailAddress'] = $emailAddress;
        $data = serialize($data);
        $redis = Cache::store('redis')->handler();
        $redis->set($redis_id, $data);
        $command = "nohup sh " . $path . "sendMail.sh $path" . "think $redis_id > log.log 2>&1 &";
        exec($command);
    }
}