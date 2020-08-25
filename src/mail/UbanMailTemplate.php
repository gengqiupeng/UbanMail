<?php

namespace uban\mail;

use think\facade\Db;

class UbanMailTemplate extends Base
{
    private $config;

    public function __construct()
    {
        $this->config = $this->getMailConfig();
    }

    /**
     * 按用户类型和模板类型获取唯一一条模板
     */
    public function getTplByUserAndType($userId, $type)
    {
        $config = $this->config;
        return Db::name($config->tplTable)
            ->where($config->tplUserIdColumn, $userId)
            ->where($config->tplTypeColumn, $type)
            ->find();
    }

    //设置模板
    public function saveTpl($data)
    {
        $config = $this->config;
        //查重
        if (array_key_exists($config->tplIdColumn, $data)) {
            $old = Db::name($config->tplTable)
                ->find($data[$config->tplIdColumn]);
        } else {
            $old = Db::name($config->tplTable)
                ->where($config->tplTypeColumn, $data[$config->tplTypeColumn])
                ->where($config->tplUserIdColumn, $data[$config->tplUserIdColumn])
                ->find();
        }
        if (empty($old)) {//新增
            return Db::name($config->tplTable)->insertGetId($data);
        } elseif (array_key_exists($config->tplIdColumn, $data)) {//更新
            return Db::name($config->tplTable)
                ->where($config->tplIdColumn, $old[$config->tplIdColumn])
                ->update($data);
        } else {//报错
            return false;
        }
    }

    public function useTpl($mail_id, $user_id)
    {
        $config = $this->config;
        $mail = Db::name($config->tplTable)
            ->find($mail_id);
        if (empty($mail)) {
            return false;
        }
        $mail[$config->tplUserIdColumn] = $user_id;
        unset($mail[$config->tplIdColumn]);
        return $this->saveTpl($mail);
    }

    public function info($mail_id)
    {
        $config = $this->config;
        $mail = Db::name($config->tplTable)
            ->find($mail_id);
        return $mail;
    }

    //用户模板列表
    public function getTplListByUserId()
    {

    }

    //类型列表
    public function getTplListByType()
    {

    }

    public function getTplListByWhere($where)
    {
        $config = $this->config;
        return Db::name($config->tplTable)
            ->where($where)
            ->select()
            ->toArray();
    }
}