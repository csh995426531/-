<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/30
 * Time: 1:23
 */
namespace app\index\model;

use think\Model;

class Log extends Model
{
    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_FAIL = 'fail';

    const ACTION_LOGIN = '登陆';
    const ACTION_LOGOUT = '登出';
    const ACTION_ITEM_INCOME = '进货入库';
    const ACTION_ITEM_RETURN_INCOME = '退货入库';
    const ACTION_ITEM_INCOME_AGREE_SUCCESS = '通过入库审核';
    const ACTION_ITEM_INCOME_AGREE_REJECT = '拒绝入库审核';
    const ACTION_ITEM_OUTGO = '销售出库';
    const ACTION_ITEM_SPECIAL_OUTGO = '特殊出库';
    const ACTION_ITEM_OUTGO_AGREE_SUCCESS = '通过出库审核';
    const ACTION_ITEM_OUTGO_AGREE_REJECT = '拒绝出库审核';
    const ACTION_ITEM_INVENTORY= '在库查询';
    const ACTION_ITEM_SEARCH = '综合查询';
    const ACTION_LOG = '日志查询';
    const ACTION_MEMBER_ADD = '添加账号';
    const ACTION_MEMBER_UPDATE_PWD = '密码修改';
    const ACTION_MEMBER_UPDATE_ACCESS = '权限修改';
    const ACTION_SETTING_CATEGORY_ADD = '增加类别';
    const ACTION_SETTING_CATEGORY_DEL = '删除类别';
    const ACTION_SETTING_NAME_ADD = '增加名称';
    const ACTION_SETTING_NAME_DEL = '删除名称';
    const ACTION_SETTING_FEATURE_ADD = '增加配置';
    const ACTION_SETTING_FEATURE_DEL = '删除配置';
    const ACTION_SETTING_APPEARANCE_ADD = '增加外观';
    const ACTION_SETTING_APPEARANCE_DEL = '删除外观';
    const ACTION_SETTING_EDITION_ADD = '增加固件版本';
    const ACTION_SETTING_EDITION_DEL = '删除固件版本';
    const ACTION_SETTING_TYPE_ADD = '增加型号';
    const ACTION_SETTING_TYPE_DEL = '删除型号';
    const ACTION_SETTING_CHANNEL_ADD = '增加进货渠道/出货途径';
    const ACTION_SETTING_CHANNEL_DEL = '删除进货渠道/出货途径';
    // const ACTION_STATISTICS_INCOME = '进货统计';
    const ACTION_STATISTICS_PROFIT = '统计';

    public function user(){
        return $this->hasOne("user", 'id', 'user_id');
    }

    public function getResponseOptions(){
        return [
            self::RESPONSE_SUCCESS => '成功',
            self::RESPONSE_FAIL => '失败',
        ];
    }

    public function getActionOptions(){
        return [
            '登陆','登出','进货入库','退货入库','通过入库审核','拒绝入库审核','出库','通过出库审核','拒绝出库审核','在库查询','综合查询','日志查询','添加账号','密码修改','权限修改','增加类别','删除类别','增加名称','删除名称','增加配置','删除配置','增加外观','删除外观','增加固件版本','删除固件版本','增加型号','删除型号','增加进货渠道/出货途径','删除进货渠道/出货途径','进货统计','利润统计'
        ];
    }
}