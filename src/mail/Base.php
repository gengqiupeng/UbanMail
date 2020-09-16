<?php

namespace uban\mail;

use think\Exception;
use think\facade\Config;
use think\facade\Session;

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
        $mailConfig = Session::get('uban_mail_config');
        if (empty($mailConfig)) {
            $mailConfig = Config::get('uban_mail.');
            if (empty($mailConfig)) {
                throw new Exception('Uban Mail Config uban_mail.php not define');
            }
            $this->mailConfig = new UbanMailConfig();
            foreach ($mailConfig as $key => $item) {
                $this->mailConfig->$key = $item;
            }
            Session::set('uban_mail_config', $this->mailConfig);
        } else {
            $this->mailConfig = $mailConfig;
        }
        return $this->mailConfig;
    }

}