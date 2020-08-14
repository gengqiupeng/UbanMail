<?php

namespace uban\mail;

class UbanMailConfig
{

    private $host = 'smtp.exmail.qq.com'; //smtp服务器
    private $from = 'noreplay@global-sci.org'; //发送者的邮件地址
    private $fromName = '期刊管理'; //发送邮件的用户昵称
    private $username = 'noreplay@global-sci.org'; //登录到邮箱的用户名
    private $password = '5985SOCj!s'; //第三方登录的授权码，在邮箱里面设置
    private $port = 465;

    public function setConfig($host, $from, $fromName, $password, $port, $userName)
    {
        $this->setHost($host)
            ->setFrom($from)
            ->setFromName($fromName)
            ->setPassword($password)
            ->setPort($port)
            ->setUsername($userName);
    }

    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function setFromName($name)
    {
        $this->fromName = $name;
        return $this;
    }

    /**
     * @param string
     * @return UbanMailConfig
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param string $password
     * @return UbanMailConfig
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param int $port
     * @return UbanMailConfig
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    
}