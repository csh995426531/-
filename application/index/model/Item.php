<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/6/2
 * Time: 17:19
 */
namespace app\index\model;

use think\Model;

class Item extends Model
{
    const STATUS_INCOME_WAIT = 1;//入库待核
    const STATUS_NORMAL = 2;//在库
    const STATUS_SOLD = 3;//已售
    const STATUS_REPAIR = 4;//维修中
    const STATUS_LOSE = 5;//盘库外
    const STATUS_FAIL = 6;//入库审核失败
    const STATUS_OUTGO_WAIT = 7;//出库待核
    const STATUS_PREPARE = 8; // 预售

    public function itemType(){
        return $this->hasOne("item_type", "id", "type_id");
    }

    public function itemFeature(){
        return $this->hasOne("item_feature", "id", "feature_id");
    }

    public function itemAppearance(){
        return $this->hasOne("item_appearance", "id", "appearance_id");
    }

    public function itemEdition(){
        return $this->hasOne("item_edition", "id", "edition_id");
    }

    public function itemCategory(){
        return $this->hasOne("item_category", "id", "category_id");
    }

    public function itemName(){
        return $this->hasOne("item_name", "id", "name_id");
    }

    public function itemChannel(){
        return $this->hasOne("item_channel", "id", "channel_id");
    }

    public function itemNetwork(){
        return $this->hasOne("item_network", "id", "network_id");
    }
  
    public function getStatusName(){

        $options = $this->getStatusOptions();

        return isset($options[$this['status']]) ? $options[$this['status']] :'';
    }

    public function getLastOutgoNo(){

        $orderNo = ItemOutgoHistory::where([
            'item_id' => ['=', $this['id']],
            'status' => ['in', [ItemOutgoHistory::STATUS_SUCCESS, ItemOutgoHistory::STATUS_RETURN]]
        ])->order('id', 'desc')->find();
        return $orderNo ? $orderNo->order_no : '';
    }

    public function getStatusOptions(){
        return [
            self::STATUS_INCOME_WAIT => '入待核',
            self::STATUS_NORMAL=> '在库',
            self::STATUS_SOLD => '已出售',
            self::STATUS_REPAIR => '维修中',
            self::STATUS_LOSE => '盘库外',
            self::STATUS_FAIL => '入库失败',
            self::STATUS_OUTGO_WAIT => '出待核',
            self::STATUS_PREPARE => '预售'
        ];
    }
}