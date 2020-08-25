<?php

namespace uban\mail;

use think\facade\Db;

class UbanMailTemplate extends Base
{
    /**
     * 按用户类型和模板类型获取唯一一条模板
     */
    public function getTplByUserAndType($userId, $type)
    {
        $config = $this->getMailConfig();
        return Db::name($config->tplTable)
            ->where($config->tplUserIdColumn, $userId)
            ->where($config->tplTypeColumn, $type)
            ->find();
    }

    //设置模板
    public function setTpl()
    {

    }

    //用户模板列表
    public function getTplListByUserId()
    {

    }

    //类型列表
    public function getTplListByType()
    {

    }
}