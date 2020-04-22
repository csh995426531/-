<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/31
 * Time: 14:45
 */
namespace app\index\model;

use think\Model;

class ItemIntelligence extends Model
{
    const STATUS_ACTIVE = 1; //状态-有效
    const STATUS_INVALID = 2; //状态-无效

    public function itemFeature()
    {
        return $this->hasOne('ItemFeature','id', 'feature_id');
    }

    public function itemAppearance()
    {
        return $this->hasOne('ItemAppearance','id', 'appearance_id');
    }

    // public function itemFeature()
    // {
    //     return $this->hasOne('ItemFeature','id', 'feature_id');
    // }

    public function itemType()
    {
        return $this->hasOne('ItemType','id', 'type_id');
    }
}