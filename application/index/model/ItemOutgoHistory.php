<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/6/2
 * Time: 18:04
 */
namespace app\index\model;

use think\Model;

class ItemOutgoHistory extends Model
{
    const STATUS_WAIT = 1;//待审核
    const STATUS_SUCCESS = 2;//成功
    const STATUS_FAIL= 3;//失败
    const STATUS_RETURN_WAIT= 4;//退货中
    const STATUS_RETURN= 5;//已退货

    public function createUser(){

        return $this->hasOne("user", "id", "create_user_id");
    }

    public function item(){
        return $this->hasOne("item", "id", "item_id");
    }

    public function itemChannel(){
        return $this->hasOne("item_channel", "id", "channel_id");
    }
}