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
use think\Session;
use think\Db;

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
    public function createHistory($itemId, $event, $eventId, $result=1, $user_id=0) {
        
        $model = new ItemHistory;
        $model->data([
            'item_id' => $itemId,
            'event' => $event,
            'event_id' => $eventId,
            'result' => $result,
            'create_time' => time(),
            'create_user_id' => $user_id,
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


    public function addIncome($params)
    {
        Db::startTrans();
        try {

            if (empty($params['date'])) {
                throw new \Exception("日期错误");
            }

            if (empty($params['type_id'])) {
                throw new \Exception("型号不能为空");
            }

            $type = ItemType::where("data", $params['type_id'])->find();

            if (empty($type) || $type->status != ItemType::STATUS_ACTIVE) {
                throw new \Exception("型号无效");
            }

            if (empty($params['category_id'])) {
                throw new \Exception("分类不能为空");
            }

            $category = ItemCategory::where("id", $params['category_id'])->find();

            if (empty($category) || $category->status != ItemCategory::STATUS_ACTIVE) {
                throw new \Exception("分类无效");
            }

            if (empty($params['name_id'])) {
                throw new \Exception("名称不能为空");
            }

            $name = ItemName::where("id", $params['name_id'])->find();

            if (empty($name) || $name->status != ItemName::STATUS_ACTIVE) {
                throw new \Exception("名称无效");
            }

            if (empty($params['feature_id'])) {
                throw new \Exception("配置不能为空");
            }

            $feature = ItemFeature::where("id", $params['feature_id'])->find();

            if (empty($feature) || $feature->status != ItemFeature::STATUS_ACTIVE) {
                throw new \Exception("配置无效");
            }

            if (empty($params['appearance_id'])) {
                throw new \Exception("外观不能为空");
            }

            $appearance = ItemAppearance::where("id", $params['appearance_id'])->find();

            if (empty($appearance) || $appearance->status != ItemAppearance::STATUS_ACTIVE) {
                throw new \Exception("外观无效");
            }

            if (empty($params['edition_id'])) {
                throw new \Exception("固件版本不能为空");
            }

            $edition = ItemEdition::where("id", $params['edition_id'])->find();

            if (empty($edition) || $edition->status != ItemEdition::STATUS_ACTIVE) {
                throw new \Exception("固件版本无效");
            }

            if (empty($params['channel_id'])) {
                throw new \Exception("渠道不能为空");
            }

            $channel = ItemChannel::where("id", $params['channel_id'])->find();

            if (empty($channel) || $channel->status != ItemChannel::STATUS_ACTIVE) {
                throw new \Exception("渠道无效");
            }

            if (empty($params['number'])) {
                throw new \Exception("序列号不能为空");
            }

            $number = strtoupper($params['number']);

            if (empty($params['price'])) {
                throw new \Exception("价格不能为空");
            }

            $price = floatval($params['price']);

            if ((!is_int($price) && !is_float($price)) || $price > 1000000 || $price < 0) {
                throw new \Exception("价格错误");
            }

            $item = \app\index\model\Item::where("number", $number)
                ->where("status", "in", [
                    \app\index\model\Item::STATUS_INCOME_WAIT,
                    \app\index\model\Item::STATUS_NORMAL,
                    \app\index\model\Item::STATUS_OUTGO_WAIT,
                    \app\index\model\Item::STATUS_PREPARE,
                    \app\index\model\Item::STATUS_LOSE,
                    ])
                ->find();

            if (!empty($item)) {
                throw new \Exception("序列号重复");
            }
          
            if (!empty($params['type_id']) && $params['type_id'] !== 0) {
                $type = ItemType::where("status", ItemType::STATUS_ACTIVE)
                    ->where("data", $params['type_id'])
                    ->find();
                
                $params['type_id'] = $type->id;
            }
            

            $model = new \app\index\model\Item;
            $model->data([
                "category_id" => $params['category_id'],
                "name_id" => $params['name_id'],
                "feature_id" => $params['feature_id'],
                "appearance_id" => $params['appearance_id'],
                "edition_id" => $params['edition_id'],
                "type_id" => $params['type_id'],
                "date" => $params['date'],
                "number" => $params['number'],
                "memo" => $params['memo'],
                "price" => $params['price'],
                "network_id" => $params['network_id'],
                "channel_id" => $params['channel_id'],
                "status" => \app\index\model\Item::STATUS_INCOME_WAIT,
                "create_time" => time(),
                "update_time" => time()
            ]);

            if (!$model->save()) {
                throw new \Exception("库存保存失败");
            }

            $itemId = $model->id;

            $model = new ItemIncomeHistory;
            $model->data([
                "type" => ItemIncomeHistory::TYPE_INCOME,
                "item_id" => $itemId,
                "create_user_id" => Session::get("user_id"),
                'update_user_id' => Session::get("user_id"),
                "status" => ItemIncomeHistory::STATUS_WAIT,
                "create_time" => time(),
                "update_time" => time()
            ]);

            if (!$model->save()) {
                throw new \Exception("入库记录保存失败");
            }
            $this->createHistory($itemId, ItemHistory::EVENT_INCOME, $model->id, 1);
            Db::commit();
            return true;
        } catch (\Exception $e) {
            Db::rollback();
            return $e->getMessage();
        }
        return $message;
    }
}