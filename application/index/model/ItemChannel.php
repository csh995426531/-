<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/31
 * Time: 14:44
 */
namespace app\index\model;

use think\Model;

class ItemChannel extends Model
{
    const TYPE_INCOME = 1; //进货类型
    const TYPE_OUTGO = 2; //出货类型
    const STATUS_ACTIVE = 1; //状态-有效
    const STATUS_INVALID = 2; //状态-无效

    public function formatTypeName($type) {
     
        $options = $this->getTypeOptions();
        return isset($options[$type]) ? $options[$type] : '';
    }

    public function getTypeOptions() {
        return [
            self::TYPE_INCOME => '进货渠道',
            self::TYPE_OUTGO => '出货渠道',
        ];
    }
}