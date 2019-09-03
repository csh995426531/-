<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/31
 * Time: 14:45
 */
namespace app\index\model;

use think\Model;

class ItemType extends Model
{
    const STATUS_ACTIVE = 1; //状态-有效
    const STATUS_INVALID = 2; //状态-无效

    public function category()
    {
        return $this->hasOne('ItemCategory','id', 'category_id');
    }

    public function itemName()
    {
        return $this->hasOne('ItemName','id', 'name_id');
    }

    // public function itemFeature()
    // {
    //     return $this->hasOne('ItemFeature','id', 'feature_id');
    // }

    public function itemNetwork()
    {
        return $this->hasOne('ItemNetwork','id', 'network_id');
    }
}