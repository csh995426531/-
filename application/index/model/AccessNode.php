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
                'index/item/inventory', 'index/item/inventorylist', 'index/item/changename', 'index/item/cancelprepare', 'index/item/prepare'
            ],
            'index/item/search' => [
                'index/item/search', 'index/item/searchlist','index/item/history',
            ],
            'index/item/income' => [
                'index/item/income', 'index/item/incomelist', 'index/item/changetype', 'index/item/checknumber', 'index/item/checkintelligence', 'index/item/addincome', 'index/item/batchaddincome', 'index/item/batchaddincomesave', 'index/item/deleteagree'
            ],
            'index/item/returnincome' => [
                'index/item/returnincome', 'index/item/returnincomelist', 'index/item/addreturnincome',
            ],
            'index/item/outgo' => [
                'index/item/outgo', 'index/item/outgolist', 'index/item/addoutgo',
            ],
            'index/item/specialoutgo' => [
                'index/item/specialoutgo', 'index/item/specialoutgolist', 'index/item/specialoutgo2', 'index/item/specialoutgo2list', 'index/item/addspecialoutgo', 'index/item/cancelspecialoutgo',
            ],
            'index/item/incomeagree' => [
                'index/item/incomeagree', 'index/item/incomeagreelist', 'index/item/allowagree','index/item/rejectagree',
            ],
            'index/item/outgoagree' => [
                'index/item/outgoagree', 'index/item/outgoagreelist', 'index/item/allowoutgoagree','index/item/rejectoutgoagree',
            ],

            // 'index/statistics/income' => [
            //     'index/statistics/income',
            // ],
            'index/statistics/profit' => [
                'index/statistics/profit',
            ],

            'index/setting/category' => [
                'index/setting/category','index/setting/categorylist','index/setting/addcategory','index/setting/delcategory', 'index/setting/opencategory'
            ],
            'index/setting/name' => [
                'index/setting/name','index/setting/namelist','index/setting/addname','index/setting/delname', 'index/setting/openname'
            ],
            'index/setting/feature' => [
                'index/setting/feature','index/setting/featurelist','index/setting/addfeature','index/setting/delfeature', 'index/setting/openfeature'
            ],
            'index/setting/appearance' => [
                'index/setting/appearance','index/setting/appearancelist','index/setting/addappearance','index/setting/delappearance', 'index/setting/openappearance'
            ],
            'index/setting/edition' => [
                'index/setting/edition','index/setting/editionlist','index/setting/addedition','index/setting/deledition', 'index/setting/openedition'
            ],
            'index/setting/type' => [
                'index/setting/type','index/setting/typelist','index/setting/addtype','index/setting/deltype', 'index/setting/opentype'
            ],
            'index/setting/incomechannel' => [
                'index/setting/incomechannel','index/setting/incomechannellist','index/setting/addchannel','index/setting/delchannel', 'index/setting/openchannel'
            ],
            'index/setting/outgochannel' => [
                'index/setting/outgochannel','index/setting/outgochannellist','index/setting/addchannel','index/setting/delchannel', 'index/setting/openchannel'
            ],
            'index/setting/network' => [
                'index/setting/network','index/setting/networklist','index/setting/addnetwork','index/setting/delnetwork', 'index/setting/opennetwork'
            ],
            'index/log/index' => [
                'index/log/index','index/log/indexlist'
            ],
            'index/setting/specialedititemlist' => [
                'index/setting/specialedititemlist', 'index/setting/specialedititemlists', 'index/setting/specialedititem'
            ],
            'index/setting/intelligence' => [
                'index/setting/intelligence','index/setting/intelligencelist','index/setting/addintelligence','index/setting/delintelligence','index/setting/openintelligence'
            ]
        ];
    }
}