<?php
namespace app\index\model;

use Think\Model;

class ItemHistory extends Model
{
    const EVENT_INCOME = 1;//进货入库
    const EVENT_INCOME_AGREE = 2;//进货审核
    const EVENT_OUTGO = 3;//销售出库
    const EVENT_OUTGO_AGREE = 4;//销售出库审核
    const EVENT_RETURN = 5; //退货入库
    const EVENT_RETURN_AGREE = 6;//退货入库审核
    const EVENT_SPECIAL_EDIT = 7;//特殊修改

    public $eventName;
    public $resultName;

    public function getResultName() {
        return $this->result == 1 ? '成功' : '失败';
    }

    public function getEventName() {
        $options = $this->getEventNameOptions();
        return isset($options[$this->event]) ? $options[$this->event] :'';
    }

    public function getEventNameOptions(){
        return [
            self::EVENT_INCOME => '进货入库',
            self::EVENT_INCOME_AGREE => '进货审核',
            self::EVENT_OUTGO => '销售出库',
            self::EVENT_OUTGO_AGREE => '销售出库审核',
            self::EVENT_RETURN => '退货入库',
            self::EVENT_RETURN_AGREE => '退货入库审核',
            self::EVENT_SPECIAL_EDIT => '特殊修改',
        ];
    }

    public function item(){
        return $this->hasOne("item", "id", "item_id");
    }

    public function incomeHistory(){
        return $this->hasOne("item_income_history", "id", "event_id");
    }

    public function outgoHistory(){
        return $this->hasOne("item_outgo_history", "id", "event_id");
    }
}