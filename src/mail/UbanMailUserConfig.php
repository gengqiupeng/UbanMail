<?php

namespace uban\mail;

use think\facade\Db;

/**
 * 用户设置自己的邮件发送配置
 * Class UbanMailUserConfig
 * @package uban\mail
 */
class UbanMailUserConfig extends Base
{
    /**
     * 用户设置配置
     * @param $data
     * @return boolean
     */
    public function setConfigById($data)
    {
        $mailConfig = $this->getMailConfig();
        $old = Db::name($mailConfig->userMailTable)->where($mailConfig->mailUserIdColumn, $data[$mailConfig->mailUserIdColumn])->find();
        if (empty($old)) {
            $result = Db::name($mailConfig->userMailTable)->insertGetId($data);
        } else {
            $result = Db::name($mailConfig->userMailTable)->where($mailConfig->mailUserIdColumn, $data[$mailConfig->mailUserIdColumn])->update($data);
        }
        return $result;
    }

    /**
     * 用户获取配置
     * @param $userId
     * @return array
     */
    public function getConfigById($userId)
    {
        $mailConfig = $this->getMailConfig();
        $userMailConfig = Db::name($mailConfig->userMailTable)->where($mailConfig->mailUserIdColumn, $userId)->find();
        return $userMailConfig;
    }
}