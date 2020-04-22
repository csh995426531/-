<?php
namespace app\index\service;

use app\index\model\ItemAppearance;
use app\index\model\ItemCategory;
use app\index\model\ItemChannel;
use app\index\model\ItemEdition;
use app\index\model\ItemFeature;
use app\index\model\ItemHistory;
use app\index\model\ItemIncomeHistory;
use app\index\model\ItemName;
use app\index\model\ItemOutgoHistory;
use app\index\model\ItemType;
use app\index\model\ItemNetwork;

/**
 * 商品服务层
 *
 * @author    cuisaihang<1114313879@qq.com>
 */
class Item
{
    public static $instance;

    public static function getInstance(){
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * 创建商品历史
     */
    public function createHistory($itemId, $event, $eventId, $result=1) {
        
        $model = new ItemHistory;
        $model->data([
            'item_id' => $itemId,
            'event' => $event,
            'event_id' => $eventId,
            'result' => $result,
            'create_time' => time()
        ]);
        if (!$model->save()) {
            throw new \Exception("保存错误");
        }
        return true;
    }

    /**
     * 获取列表
     *
     * @param array $params
     * @return void
     * @author CSH <1114313879@qq.com>
     */
    public function getList($params){
        $lists = \app\index\model\Item::where('id', '>', '0');
        
        if (!empty($params['type_id'])) {
            $typeArr = ItemType::where("data", $params['type_id'])->column('id');
            $lists = $lists->where("type_id",  'in', $typeArr);
        }

        if (!empty($params['name_id'])) {
            $nameArr = ItemName::where("data", $params['name_id'])->column('id');
            $lists = $lists->where("name_id",  'in', $nameArr);
        }
        
        if (!empty($params['feature_id'])) {
            $featureArr = ItemFeature::where("data", $params['feature_id'])->column('id');
            $lists = $lists->where("feature_id",  'in', $featureArr);
        }

        if (!empty($params['network_id'])) {
            $networkArr = ItemNetwork::where("data", $params['network_id'])->column('id');
            // $typeArr2 = ItemType::where("network_id" ,  'in',  $networkArr)->field("id")->select();
            $lists = $lists->where("network_id",  'in', $networkArr);
        }
   
        if (!empty($params['appearance_id'])) {
            $appearanceArr = ItemAppearance::where("data", $params['appearance_id'])->column('id');
            $lists = $lists->where("appearance_id",  'in', $appearanceArr);
        }

        if (!empty($params['category_id'])) {
            $categoryArr = ItemCategory::where("data", $params['category_id'])->column('id');
            $lists = $lists->where("category_id",  'in', $categoryArr);
        }

        if (!empty($params['edition_id'])) {
            $editionArr = ItemEdition::where("data", $params['edition_id'])->column('id');
            $lists = $lists->where("edition_id",  'in', $editionArr);
        }

        if (!empty($params['channel_id'])) {
            $channelArr = ItemChannel::where("data", $params['channel_id'])->column('id');
            $lists = $lists->where("channel_id",  'in', $channelArr);
        }

        if (!empty($params['date']) && $params['date'] > 0) {
            $lists = $lists->where("date",  '=', $params['date']);
        }

        if (!empty($params['status'])) {
            if (\is_numeric($params['status']) && $params['status'] > 0) {
                $lists = $lists->where("status",  '=', $params['status']);
            } elseif (is_array($params['status'])) {
                $lists = $lists->where("status",  'in', $params['status']);
            }
        }

        if (!empty($params['keyword'])) {
            $lists = $lists->where("number",  'LIKE', "%". trim($params['keyword']) . "%");
        }

        $data = $lists->paginate(10, false, ['query'=> $params]);
        
        // echo $lists->getLastSql();
        foreach ($data as &$temp) {
            $temp->statusName = $temp->getStatusName();
            $temp->lastOutNo = $temp->getLastOutgoNo();
        }

        return $data;
    }
}