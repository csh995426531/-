<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/6/2
 * Time: 18:03
 */
namespace app\index\model;

use think\Model;

class ItemIncomeHistory extends Model
{
    const TYPE_INCOME = 1;//进货入库
    const TYPE_RETURN_INCOME = 2;//退货入库

    const STATUS_WAIT = 1;//待审核
    const STATUS_SUCCESS = 2;//成功
    const STATUS_FAIL= 3;//失败

    public function getTypeName(){

        $options = $this->getTypeNameOptions();

        return isset($options[$this['type']]) ? $options[$this['type']] : '';
    }

    public function getTypeNameOptions(){
        return [
            self::TYPE_INCOME => '进货入库',
            self::TYPE_RETURN_INCOME => '退货入库',
        ];
    }

    public function createUser(){

        return $this->hasOne("user", "id", "create_user_id");
    }

    public function item(){
        return $this->hasOne("item", "id", "item_id");
    }

    public function itemOutgoHistory(){
        return $this->hasOne("item_outgo_history", "id", "outgo_history_id");
    }
}