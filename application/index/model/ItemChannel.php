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
}