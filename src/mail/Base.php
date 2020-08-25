<?php

namespace uban\mail;

use think\Exception;
use think\facade\Config;

class Base
{

    /**
     * @var \uban\mail\Config
     */
    private $mailConfig;


    /**
     * @return \uban\mail\Config
     * @throws Exception
     */
    public function getMailConfig()
    {
        $mailConfig = session('uban_mail_config');
        if (empty($mailConfig)) {
            $mailConfig = Config::get('uban_mail');
            if (empty($mailConfig)) {
                throw new Exception('Uban Mail Config uban_user.php not define');
            }
            $this->mailConfig = new \uban\base\Config();
            foreach ($mailConfig as $key => $item) {
                $this->mailConfig->$key = $item;
            }
            session('uban_mail_config', $this->mailConfig);
        } else {
            $this->mailConfig = $mailConfig;
        }
        return $this->mailConfig;
    }

}