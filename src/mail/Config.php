<?php

namespace uban\mail;

/**
 * @property $userMailTable;
 * @property $hostColumn;
 * @property $passwordColumn;
 * @property $fromNameColumn;
 * @property $mailUserIdColumn;
 * @property $portColumn;
 * @property  $host;
 * @property $fromName;
 * @property $password;
 * @property $mailUser;
 * @property $port;
 * @property $tplTable;
 * @property $tplIdColumn;
 * @property $tplTitleColumn;
 * @property $tplUserIdColumn;
 * @property $tplTypeColumn;
 * @property $tplContentColumn;
 * Class Config
 * @package uban\mail
 */
class Config
{
    private $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data))
            return $this->data[$name];
        return NULL;
    }

}