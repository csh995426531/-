<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/31
 * Time: 14:43
 */
namespace app\index\model;

use think\Model;

class ItemCategory extends Model
{
    const STATUS_ACTIVE = 1; //状态-有效
    const STATUS_INVALID = 2; //状态-无效
}