<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/30
 * Time: 14:29
 */
namespace app\index\model;

use think\Model;

class AccessNode extends Model
{
    public function getNodeChildren(){

        return [
            'index/members/add' => [
                'index/members/add',
            ],
            'index/members/updatepwd' => [
                'index/members/updatepwd',
            ],
            'index/members/updateaccess' => [
                'index/members/updateaccess',
            ],

            'index/item/inventory' => [
                'index/item/inventory', 'index/item/changename', 'index/item/cancelprepare', 'index/item/prepare'
            ],
            'index/item/search' => [
                'index/item/search',
            ],
            'index/item/income' => [
                'index/item/income', 'index/item/changetype', 'index/item/checknumber', 'index/item/addincome', 'index/item/deleteagree'
            ],
            'index/item/returnincome' => [
                'index/item/returnincome', 'index/item/addreturnincome',
            ],
            'index/item/outgo' => [
                'index/item/outgo', 'index/item/addoutgo',
            ],
            'index/item/specialoutgo' => [
                'index/item/specialoutgo', 'index/item/specialoutgo2', 'index/item/addspecialoutgo', 'index/item/cancelspecialoutgo',
            ],
            'index/item/incomeagree' => [
                'index/item/incomeagree','index/item/allowagree','index/item/rejectagree',
            ],
            'index/item/outgoagree' => [
                'index/item/outgoagree','index/item/allowoutgoagree','index/item/rejectoutgoagree',
            ],

            // 'index/statistics/income' => [
            //     'index/statistics/income',
            // ],
            'index/statistics/profit' => [
                'index/statistics/profit',
            ],

            'index/setting/category' => [
                'index/setting/category','index/setting/addcategory','index/setting/delcategory', 'index/setting/opencategory'
            ],
            'index/setting/name' => [
                'index/setting/name','index/setting/addname','index/setting/delname', 'index/setting/openname'
            ],
            'index/setting/feature' => [
                'index/setting/feature','index/setting/addfeature','index/setting/delfeature', 'index/setting/openfeature'
            ],
            'index/setting/appearance' => [
                'index/setting/appearance','index/setting/addappearance','index/setting/delappearance', 'index/setting/openappearance'
            ],
            'index/setting/edition' => [
                'index/setting/edition','index/setting/addedition','index/setting/deledition', 'index/setting/openedition'
            ],
            'index/setting/type' => [
                'index/setting/type','index/setting/addtype','index/setting/deltype', 'index/setting/opentype'
            ],
            'index/setting/incomechannel' => [
                'index/setting/incomechannel','index/setting/addchannel','index/setting/delchannel', 'index/setting/openchannel'
            ],
            'index/setting/outgochannel' => [
                'index/setting/outgochannel','index/setting/addchannel','index/setting/delchannel', 'index/setting/openchannel'
            ],
            'index/setting/network' => [
                'index/setting/network','index/setting/addnetwork','index/setting/delnetwork', 'index/setting/opennetwork'
            ],
            'index/log/index' => [
                'index/log/index'
            ]
        ];
    }
}