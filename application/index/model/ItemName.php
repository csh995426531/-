<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/31
 * Time: 14:45
 */
namespace app\index\model;

use think\Model;

class ItemName extends Model
{
    const STATUS_ACTIVE = 1; //状态-有效
    const STATUS_INVALID = 2; //状态-无效

    public function category()
    {
        return $this->hasOne('ItemCategory','id', 'category_id');
    }

    public function itemFeature()
    {
        return $this->hasMany('ItemFeature','name_id', 'id');
    }

    public function itemNetwork()
    {
        return $this->hasMany('ItemNetwork','name_id', 'id');
    }

    public function itemEdition()
    {
        return $this->hasMany('ItemEdition','name_id', 'id');
    }

    public function itemAppearance()
    {
        return $this->hasMany('ItemAppearance','name_id', 'id');
    }

    public function itemType()
    {
        return $this->hasMany('ItemType','name_id', 'id');
    }

}