<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/6/1
 * Time: 17:23
 */
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\ItemAppearance;
use app\index\model\ItemCategory;
use app\index\model\ItemChannel;
use app\index\model\ItemEdition;
use app\index\model\ItemFeature;
use app\index\model\ItemIncomeHistory;
use app\index\model\ItemName;
use app\index\model\ItemOutgoHistory;
use app\index\model\ItemType;
use app\index\model\ItemNetwork;
use think\Db;
use think\Session;
use app\index\model\User;

class Item extends BaseController
{

    // 入库记录处理
    public function income() {

        $userIds = ItemIncomeHistory::distinct(true)->field('create_user_id')->select();

        $users = User::where('id', 'in', array_column($userIds, 'create_user_id'))->select();

        $nameIds = Db::name('item_income_history')
            ->alias('t')
            ->join('item i', 'i.id = t.item_id')
            ->distinct(true)
            ->field('i.name_id')
            ->select();

        $names = ItemName::where('id', 'in', array_column($nameIds, 'name_id'))->select();

        $channelIds = Db::name('item_income_history')
        ->alias('t')
        ->join('item i', 'i.id = t.item_id')
        ->distinct(true)
        ->field('i.channel_id')
        ->select();

        $channels = ItemChannel::where("id", 'in', array_column($channelIds, 'channel_id'))->select();


        $sql = ItemIncomeHistory::alias('t')
            ->field('t.*')
            ->join('item i', 'i.id=t.item_id')
            ->where("t.status", 'in', [
                ItemIncomeHistory::STATUS_WAIT, 
                ItemIncomeHistory::STATUS_FAIL
            ]);

        $user_id = $this->request->get('user_id');

        if (!empty($user_id) && $user_id > 0) {
            $sql = $sql->where('t.create_user_id', $user_id);
        }

        $date = $this->request->get('date');

        if (!empty($date)) {

            $start_time = strtotime($date. '00:00:00');
            $end_time = strtotime($date. '23:59:59');
            $sql = $sql->where('t.create_time',  '>=', $start_time)->where('t.create_time', '<=', $end_time);
        }

        $name_id = $this->request->get('name_id');

        if (!empty($name_id) && $name_id > 0) {
            $sql = $sql->where('i.name_id', $name_id);
        }

        $channel_id = $this->request->get('channel_id');

        if (!empty($channel_id) && $channel_id > 0) {
            $sql = $sql->where('i.channel_id', $channel_id);
        }

        $lists = $sql->paginate(10);
    
        $breadcrumb = '入库记录处理';

        return $this->fetch('income', [
            'users' => $users,
            'names' => $names,
            'channels' => $channels,
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //进货入库
    public function addIncome(){

        $id = $this->request->get('id');
        if ($id) {
            $history = ItemIncomeHistory::where('id', $id)->find();
        } else {
            $history = false;
        }

        if ($this->request->isPost()) {

            $date = $this->request->post("date");
            $typeId = $this->request->post("type_id", 0);
            $categoryTd = $this->request->post("category_id");
            $nameId = $this->request->post("name_id");
            $featureId = $this->request->post("feature_id");

            $appearanceId = $this->request->post("appearance_id");
            $number = $this->request->post("number");
            $editionId = $this->request->post("edition_id");
            $memo = $this->request->post("memo");
            $price = $this->request->post("price");
            $channelId = $this->request->post("channel_id");
            $networkId = $this->request->post("network_id", 0);

            Db::startTrans();
            try {

                if (empty($date)) {
                    throw new \Exception("日期错误");
                }

                if (empty($categoryTd)) {
                    throw new \Exception("分类不能为空");
                }

                $category = ItemCategory::where("id", $categoryTd)->find();

                if (empty($category) || $category->status != ItemCategory::STATUS_ACTIVE) {
                    throw new \Exception("分类无效");
                }

                if (empty($nameId)) {
                    throw new \Exception("名称不能为空");
                }

                $name = ItemName::where("id", $nameId)->find();

                if (empty($name) || $name->status != ItemName::STATUS_ACTIVE) {
                    throw new \Exception("名称无效");
                }

                if (empty($featureId)) {
                    throw new \Exception("配置不能为空");
                }

                $feature = ItemFeature::where("id", $featureId)->find();

                if (empty($feature) || $feature->status != ItemFeature::STATUS_ACTIVE) {
                    throw new \Exception("配置无效");
                }

                if (empty($appearanceId)) {
                    throw new \Exception("外观不能为空");
                }

                $appearance = ItemAppearance::where("id", $appearanceId)->find();

                if (empty($appearance) || $appearance->status != ItemAppearance::STATUS_ACTIVE) {
                    throw new \Exception("外观无效");
                }

                if (empty($editionId)) {
                    throw new \Exception("固件版本不能为空");
                }

                $edition = ItemEdition::where("id", $editionId)->find();

                if (empty($edition) || $edition->status != ItemEdition::STATUS_ACTIVE) {
                    throw new \Exception("固件版本无效");
                }

                if (empty($channelId)) {
                    throw new \Exception("渠道不能为空");
                }

                $channel = ItemChannel::where("id", $channelId)->find();

                if (empty($channel) || $channel->status != ItemChannel::STATUS_ACTIVE) {
                    throw new \Exception("渠道无效");
                }

                if (empty($number)) {
                    throw new \Exception("序列号不能为空");
                }

                if (empty($price)) {
                    throw new \Exception("价格不能为空");
                }

                $price = floatval($price);

                if ((!is_int($price) && !is_float($price)) || $price > 1000000 || $price < 0) {
                    throw new \Exception("价格错误");
                }

                $item = \app\index\model\Item::where("number", $number)
                    ->where("status", "in", [
                        \app\index\model\Item::STATUS_INCOME_WAIT,
                        \app\index\model\Item::STATUS_NORMAL,
                        \app\index\model\Item::STATUS_OUTGO_WAIT,
                        ])
                    ->find();

                if (!empty($item) && $item->id != $history->item->id) {
                    throw new \Exception("该型号下该序列号已存在库中");
                }
              
                if (!empty($typeId) && $typeId !== 0) {
                    $type = ItemType::where("status", ItemType::STATUS_ACTIVE)
                    ->where("data", $typeId)
                    ->find();
                    
                    $typeId = $type->id;
                }
                
                if (!empty($history)) {
                    $model = new \app\index\model\Item;
                    $updated = $model->save([
                        "category_id" => $categoryTd,
                        "name_id" => $nameId,
                        "feature_id" => $featureId,
                        "appearance_id" => $appearanceId,
                        "edition_id" => $editionId,
                        "type_id" => $typeId,
                        "date" => $date,
                        "number" => $number,
                        "memo" => $memo,
                        "price" => $price,
                        "network_id" => $networkId,
                        "channel_id" => $channelId,
                        "status" => \app\index\model\Item::STATUS_INCOME_WAIT,
                        "update_time" => time()
                    ], ['id' => $history->item->id]);
    
                    if (!$updated) {
                        throw new \Exception("库存更新失败");
                    }
    
                    $model = new ItemIncomeHistory;
                    $updated = $model->save([
                        "status" => ItemIncomeHistory::STATUS_WAIT,
                        "update_time" => time()
                    ], ['id' => $history->id]);
    
                    if (!$updated) {
                        throw new \Exception("入库记录更新失败");
                    }

                    $history = ItemIncomeHistory::where('id', $id)->find();
                } else {
                    $model = new \app\index\model\Item;
                    $model->data([
                        "category_id" => $categoryTd,
                        "name_id" => $nameId,
                        "feature_id" => $featureId,
                        "appearance_id" => $appearanceId,
                        "edition_id" => $editionId,
                        "type_id" => $typeId,
                        "date" => $date,
                        "number" => $number,
                        "memo" => $memo,
                        "price" => $price,
                        "network_id" => $networkId,
                        "channel_id" => $channelId,
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
                        "status" => ItemIncomeHistory::STATUS_WAIT,
                        "create_time" => time(),
                        "update_time" => time()
                    ]);
    
                    if (!$model->save()) {
                        throw new \Exception("入库记录保存失败");
                    }
                }

                Db::commit();
                $message = Message('', true);
                AddLog(\app\index\model\Log::ACTION_ITEM_INCOME, json_encode($this->request->param())
                    , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
            } catch (\Exception $e) {
                Db::rollback();
                $message = Message($e->getMessage(), false);
                AddLog(\app\index\model\Log::ACTION_ITEM_INCOME, json_encode($this->request->param())
                    , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
            }

        } else {

            $message = '';
        }

        $names = ItemName::where("status", ItemName::STATUS_ACTIVE)->select();
        
        foreach ($names as $name) {
            $name->itemNetwork = ItemNetwork::where([
                "name_id" => $name->id,
                "status" => ItemNetwork::STATUS_ACTIVE
            ])->select();

            $name->itemAppearance = ItemAppearance::where([
                "name_id" => $name->id,
                "status" => ItemAppearance::STATUS_ACTIVE
            ])->select();

            $name->itemFeature = ItemFeature::where([
                "name_id" => $name->id,
                "status" => ItemFeature::STATUS_ACTIVE
            ])->select();

            $name->itemEdition = ItemEdition::where([
                "name_id" => $name->id,
                "status" => ItemEdition::STATUS_ACTIVE
            ])->select();
        }

        // var_dump($names);die;
        $channels = ItemChannel::where("type", ItemChannel::TYPE_INCOME)
            ->where("status", ItemChannel::STATUS_ACTIVE)
            ->select();
        
        $breadcrumb = $history ?  '入库记录修改' : '进货入库';

        return $this->fetch('add_income', [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
            'names' => $names,
            'channels' => $channels,
            'history' => $history,
        ]);
    }

    public function changeType(){

        $type = $this->request->get('type');

        if (!empty($type)) {
            
            $types = ItemType::where("status", ItemType::STATUS_ACTIVE)
                ->where("data", $type)
                ->select();
            if (empty($types)) {
                $result = SetResult(500, '型号还未录入');
            } else {

                foreach ($types as &$type) {
                    $type->itemName= $type->itemName;
                    $type->itemNetwork= $type->itemNetwork;
        
                    $type->itemName->itemAppearance = ItemAppearance::where([
                        "name_id" => $type->name_id,
                        "status" => ItemAppearance::STATUS_ACTIVE
                    ])->select();
        
                    $type->itemName->itemFeature = ItemFeature::where([
                        "name_id" => $type->name_id,
                        "status" => ItemFeature::STATUS_ACTIVE
                    ])->select();
        
                    $type->itemName->itemEdition = ItemEdition::where([
                        "name_id" => $type->name_id,
                        "status" => ItemEdition::STATUS_ACTIVE
                    ])->select();
                }

                $result = SetResult(200, $types);
            }
            return $result;
        }
    }

    public function checkNumber(){

        $result = SetResult(200, 'SUCCESS');

        $number = $this->request->get("number");
        $itemId = $this->request->get('id');

        if (empty($number)) {
            $result = SetResult(500, '序列号不能为空');
        } elseif (strlen($number) != 12) {
            $result = SetResult(500, '长度必须为12位');
        } elseif (stripos($number, 'O') !== false || stripos($number, 'I') !== false) {
            $result = SetResult(500, '不能含有字母O或I');
        } else {
            $item = \app\index\model\Item::where("number", '=', $number)->where('id', '<>', $itemId)->find();
            if (!empty($item)){
                $result = SetResult(500, '该序列号已存在');
            }
        }

        return $result;
    }

    //退货入库
    public function returnIncome($keyword=''){

        $lists = ItemOutgoHistory::alias("t")
            ->join("item i", 't.item_id=i.id')
            ->where("t.status", ItemOutgoHistory::STATUS_SUCCESS);


        if (!empty($keyword)) {
            $lists = $lists->where("t.order_no", "like", "%".$keyword."%")
                ->whereOr("t.consignee_nickname", "like", "%".$keyword."%")
                ->whereOr('i.number','like',"%".$keyword."%");
        }

        $lists = $lists->field('t.*')
            ->paginate(10);     

        $breadcrumb = '退货入库';

        return $this->fetch('return_income', [
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //增加退货入库
    public function addReturnIncome(){

        $result = SetResult(200, '操作成功');

        $id = $this->request->post('id');

        Db::startTrans();

        try {

            if(empty($id)) {
                throw new \Exception("id不能为空");
            }

            $history = ItemOutgoHistory::where("id", $id)->find();

            if (empty($history) || $history->status != ItemOutgoHistory::STATUS_SUCCESS) {
                throw new \Exception("出库记录无效");
            }

            $item = $history->item;

            if (empty($item) || $item->status != \app\index\model\Item::STATUS_SOLD) {
                throw new \Exception("库存记录无效");
            }

            $updated = $history->save([
                'status' => ItemOutgoHistory::STATUS_RETURN_WAIT,
                'update_time' => time(),
            ], [
                'id' => $history->id,
                'status' => ItemOutgoHistory::STATUS_SUCCESS
            ]);

            if ($updated != 1){
                throw new \Exception("出库记录更新失败");
            }

            $updated = $item->save([
                'status' => \app\index\model\Item::STATUS_INCOME_WAIT,
                'update_time' => time(),
            ], [
                'id' => $item->id,
                'status' => \app\index\model\Item::STATUS_SOLD
            ]);

            if ($updated != 1){
                throw new \Exception("库存记录更新失败");
            }

            $model = new ItemIncomeHistory;
            $model->data([
                'type' => ItemIncomeHistory::TYPE_RETURN_INCOME,
                'item_id' => $item->id,
                'outgo_history_id' => $history->id,
                'create_user_id' => Session::get("user_id"),
                'status' => ItemIncomeHistory::STATUS_WAIT,
                'create_time' => time(),
                'update_time' => time()
            ]);

            if (!$model->save()) {
                throw new \Exception("入库记录保存失败");
            }

            Db::commit();
            AddLog(\app\index\model\Log::ACTION_ITEM_RETURN_INCOME, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        } catch (\Exception $e) {

            Db::rollback();
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_ITEM_RETURN_INCOME, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //入库审核
    public function incomeAgree(){

        $userIds = ItemIncomeHistory::distinct(true)->field('create_user_id')->select();

        $users = User::where('id', 'in', array_column($userIds, 'create_user_id'))->select();

        $nameIds = Db::name('item_income_history')
            ->alias('t')
            ->join('item i', 'i.id = t.item_id')
            ->distinct(true)
            ->field('i.name_id')
            ->select();

        $names = ItemName::where('id', 'in', array_column($nameIds, 'name_id'))->select();

        $channelIds = Db::name('item_income_history')
        ->alias('t')
        ->join('item i', 'i.id = t.item_id')
        ->distinct(true)
        ->field('i.channel_id')
        ->select();

        $channels = ItemChannel::where("id", 'in', array_column($channelIds, 'channel_id'))->select();

        $sql = ItemIncomeHistory::alias('t')->join('item i', 'i.id=t.item_id')->where("t.status", ItemIncomeHistory::STATUS_WAIT);

        $user_id = $this->request->get('user_id');

        if (!empty($user_id) && $user_id > 0) {
            $sql = $sql->where('t.create_user_id', $user_id);
        }

        $date = $this->request->get('date');

        if (!empty($date)) {

            $start_time = strtotime($date. '00:00:00');
            $end_time = strtotime($date. '23:59:59');
            $sql = $sql->where('t.create_time',  '>=', $start_time)->where('t.create_time', '<=', $end_time);
        }

        $name_id = $this->request->get('name_id');

        if (!empty($name_id) && $name_id > 0) {
            $sql = $sql->where('i.name_id', $name_id);
        }

        $channel_id = $this->request->get('channel_id');

        if (!empty($channel_id) && $channel_id > 0) {
            $sql = $sql->where('i.channel_id', $channel_id);
        }

        $sql2 = clone($sql);
        $count = $sql2->count();        

        $sql3 = clone($sql);
        $total = $sql3->sum('i.price');

        $lists = $sql->field('t.*')
        ->paginate(10);
       
        foreach ($lists as $list) {

            $list->typeName = $list->getTypeName();
            if ($list->item->network_id == 0 )  {
                $list->item->network_id = $list->item->itemNetwork->data;
            }
        }

        $breadcrumb = '入库审核';

        return $this->fetch('income_agree', [
            'users' => $users,
            'names' => $names,
            'channels' => $channels,
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
            'count' => $count ,
            'total' => $total
        ]);
    }

    //通过入库审核
    public function allowAgree(){

        $id = $_POST['id'];
       
        if ( empty($id)) {
           return SetResult(500, 'id不能为空');
        }

        if (is_array(($id))) {

            $success =0;
            $fail = 0;

            foreach ($id as $temp) {
                $result = $this->doAllowAgree($temp);

                if ($result['code'] == 200) {
                    $success++;
                } else {
                    $fail++;
                }
            }

            if ($success >0) {
                $msg = '成功：'. $success.'，失败：'. $fail;
                $result = SetResult(200, $msg);
            } else {
                $result = SetResult(500, '操作失败');
            }
        } else {
            $result = $this->doAllowAgree($id);
        }

        return $result;
    }

    public function doAllowAgree($id){
        $result = SetResult(200, '保存成功');

        Db::startTrans();
        try {

            $history = ItemIncomeHistory::where("id", $id)->find();

            if (empty($history) || $history->status != ItemIncomeHistory::STATUS_WAIT) {
                throw new \Exception("入库记录无效");
            }

            $updated = $history->save([
                'status' => ItemIncomeHistory::STATUS_SUCCESS,
                'update_time' => time(),
            ], [
                'id' => $history->id,
                'status' => ItemIncomeHistory::STATUS_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("入库记录更新失败");
            }

            $item = $history->item;

            if (empty($item) || $item->status != \app\index\model\Item::STATUS_INCOME_WAIT) {
                throw new \Exception("库存记录无效");
            }

            $updated = $item->save([
                'status' => \app\index\model\Item::STATUS_NORMAL,
                'update_time' => time()
            ], [
                'id' => $item->id,
                'status' =>  \app\index\model\Item::STATUS_INCOME_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("库存记录更新失败");
            }

            //退货入库
            if ($history->outgo_history_id > 0 ) {

                $outgoHistory = $history->itemOutgoHistory;

                $updated = $outgoHistory->save([
                    'status' => ItemOutgoHistory::STATUS_RETURN,
                    'update_time' => time(),
                ], [
                    'id' => $outgoHistory->id,
                    'status' => ItemOutgoHistory::STATUS_RETURN_WAIT,
                ]);

                if ($updated != 1) {
                    throw new \Exception("出库记录更新失败");
                }
            }

            Db::commit();
            AddLog(\app\index\model\Log::ACTION_ITEM_INCOME_AGREE_SUCCESS, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            Db::rollback();
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_ITEM_INCOME_AGREE_SUCCESS, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //拒绝入库审核
    public function rejectAgree(){
        

        $id = $_POST['id'];

        if ( empty($id)) {
            return SetResult(500, 'id不能为空');
         }

         if (is_array($id)) {
            $success =0;
            $fail = 0;

            foreach ($id as $temp) {
                $result = $this->doRejectAgree($temp);

                if ($result['code'] == 200) {
                    $success++;
                } else {
                    $fail++;
                }
            }

            if ($success >0) {
                $msg = '成功：'. $success.'，失败：'. $fail;
                $result = SetResult(200, $msg);
            } else {
                $result = SetResult(500, '操作失败');
            }
         } else {
             $result = $this->doRejectAgree($id);
         }

         return $result;
    }

    public function doRejectAgree($id) {

        $result = SetResult(200, '操作成功');
        Db::startTrans();
        try {

            if ( empty($id)) {
                throw new \Exception("id不能为空");
            }

            $history = ItemIncomeHistory::where("id", $id)->find();

            if (empty($history) || $history->status != ItemIncomeHistory::STATUS_WAIT) {
                throw new \Exception("入库记录无效");
            }

            $updated = $history->save([
                'status' => ItemIncomeHistory::STATUS_FAIL,
                'update_time' => time(),
            ], [
                'id' => $history->id,
                'status' => ItemIncomeHistory::STATUS_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("入库记录更新失败");
            }

            $item = $history->item;

            if (empty($item) || $item->status != \app\index\model\Item::STATUS_INCOME_WAIT) {
                throw new \Exception("库存记录无效");
            }

            //退货入库
            if ($history->outgo_history_id > 0 ) {

                $updated = $item->save([
                    'status' => \app\index\model\Item::STATUS_SOLD,
                    'update_time' => time(),
                ], [
                    'id' => $item->id,
                    'status' => \app\index\model\Item::STATUS_INCOME_WAIT
                ]);

                if ($updated != 1) {
                    throw new \Exception("库存记录更新失败");
                }

                $outgoHistory = $history->itemOutgoHistory;

                $updated = $outgoHistory->save([
                    'status' => ItemOutgoHistory::STATUS_SUCCESS,
                    'update_time' => time(),
                ], [
                    'id' => $outgoHistory->id,
                    'status' => ItemOutgoHistory::STATUS_RETURN_WAIT,
                ]);

                if ($updated != 1) {
                    throw new \Exception("出库记录更新失败");
                }
            } else {

                $updated = $item->save([
                    'status' => \app\index\model\Item::STATUS_FAIL,
                    'update_time' => time(),
                ], [
                    'id' => $item->id,
                    'status' => \app\index\model\Item::STATUS_INCOME_WAIT
                ]);

                if ($updated != 1) {
                    throw new \Exception("库存记录更新失败");
                }
            }

            Db::commit();
            AddLog(\app\index\model\Log::ACTION_ITEM_INCOME_AGREE_REJECT, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            Db::rollback();
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_ITEM_INCOME_AGREE_REJECT, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //产品出库
    public function outgo(){

        $lists = \app\index\model\Item::where("status", "in", [
            \app\index\model\Item::STATUS_NORMAL,
            \app\index\model\Item::STATUS_OUTGO_WAIT
        ]);

        $typeId = $this->request->get("type_id");

        if (!empty($typeId) && $typeId > 0) {
            $lists = $lists->where("type_id", $typeId);
        }

        $nameId = $this->request->get("name_id");

        if (!empty($nameId) && $nameId > 0) {
            $lists = $lists->where("name_id", $nameId);
        }

        $featureId = $this->request->get("feature_id");

        if (!empty($featureId) && $featureId > 0) {
            $lists = $lists->where("feature_id", $featureId);
        }

        $appearanceId = $this->request->get("appearance_id");

        if (!empty($appearanceId) && $appearanceId > 0) {
            $lists = $lists->where("appearance_id", $appearanceId);
        }

        $lists = $lists->paginate(10);

        foreach ($lists as $list) {
            $list->statusName = $list->getStatusName();
        }

        $types = ItemType::where("status", ItemType::STATUS_ACTIVE)->select();

        $names = ItemName::where("status", ItemName::STATUS_ACTIVE)->select();

        $features = ItemFeature::where("status", ItemFeature::STATUS_ACTIVE)->select();

        $appearances = ItemAppearance::where("status", ItemAppearance::STATUS_ACTIVE)->select();

        $channels = ItemChannel::where("type", ItemChannel::TYPE_OUTGO)
            ->where("status", ItemChannel::STATUS_ACTIVE)
            ->select();

        $breadcrumb = '销售出库';

        return $this->fetch('outgo', [
            'breadcrumb' => $breadcrumb,
            'channels' => $channels,
            'lists' => $lists,
            'types' => $types,
            'names' => $names,
            'features' => $features,
            'appearances' => $appearances,
        ]);
    }

    //特殊出库
    public function specialOutgo(){
        $lists = \app\index\model\Item::where("status", "in", [
            \app\index\model\Item::STATUS_NORMAL,
            \app\index\model\Item::STATUS_OUTGO_WAIT
        ]);

        $typeId = $this->request->get("type_id");

        if (!empty($typeId) && $typeId > 0) {
            $lists = $lists->where("type_id", $typeId);
        }

        $nameId = $this->request->get("name_id");

        if (!empty($nameId) && $nameId > 0) {
            $lists = $lists->where("name_id", $nameId);
        }

        $featureId = $this->request->get("feature_id");

        if (!empty($featureId) && $featureId > 0) {
            $lists = $lists->where("feature_id", $featureId);
        }

        $appearanceId = $this->request->get("appearance_id");

        if (!empty($appearanceId) && $appearanceId > 0) {
            $lists = $lists->where("appearance_id", $appearanceId);
        }

        $lists = $lists->paginate(10);

        foreach ($lists as $list) {
            $list->statusName = $list->getStatusName();
        }

        $types = ItemType::where("status", ItemType::STATUS_ACTIVE)->select();

        $names = ItemName::where("status", ItemName::STATUS_ACTIVE)->select();

        $features = ItemFeature::where("status", ItemFeature::STATUS_ACTIVE)->select();

        $appearances = ItemAppearance::where("status", ItemAppearance::STATUS_ACTIVE)->select();

        $channels = ItemChannel::where("type", ItemChannel::TYPE_OUTGO)
            ->where("status", ItemChannel::STATUS_ACTIVE)
            ->select();

        $breadcrumb = '特殊出库';

        return $this->fetch('special_outgo', [
            'breadcrumb' => $breadcrumb,
            'channels' => $channels,
            'lists' => $lists,
            'types' => $types,
            'names' => $names,
            'features' => $features,
            'appearances' => $appearances,
        ]);
    }

    // 增加特殊出库
    public function addSpecialOutgo(){
        $result = SetResult(200, '操作成功');

        $itemId = $this->request->param('item_id');
        $status = $this->request->param('type');

        if ($this->request->isPost()) {

            try {
                if (empty($itemId)) {
                    throw new Exception("itemid错误");
                }
                if (!in_array($status,  [4,5])) {
                    throw new Exception("操作类型错误");
                }

                $item = \app\index\model\Item::where("id", $itemId)->find();

                if (empty($item) || $item->status != \app\index\model\Item::STATUS_NORMAL) {
                    throw new \Exception("库存物品无效");
                }

                $updated = $item->save([
                    'status' => $status,
                    'update_time' => time(),
                ], [
                    'id' => $item->id,
                    'status' => \app\index\model\Item::STATUS_NORMAL
                ]);

                if ($updated != 1) {
                    throw new \Exception("库存更新失败");
                }
                
                AddLog(\app\index\model\Log::ACTION_ITEM_SPECIAL_OUTGO, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
            } catch (\Exception $e) {
                $result = SetResult(500, $e->getMessage());
                AddLog(\app\index\model\Log::ACTION_ITEM_SPECIAL_OUTGO, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
            }
        } else {
            $result = SetResult(500, '请求方式错误');
        }

        return $result;
    }

    //添加出库记录
    public function addOutgo(){

        $result = SetResult(200, '操作成功');

        $itemId = $this->request->param('item_id');

        if ($this->request->isPost()) {

            $channelId = $this->request->post('channel_id', 0);
            $order_no = $this->request->post('order_no');
            $price = $this->request->post('price');
            $consignee_nickname = $this->request->post('consignee_nickname','');
            $consignee = $this->request->post('consignee','');
            $consignee_address = $this->request->post('consignee_address','');
            $consignee_phone = $this->request->post('consignee_phone','');
            $memo = $this->request->post('memo','');
            $cost = $this->request->post("cost");

            Db::startTrans();
            try {

                if (empty($order_no)) {
                    throw new \Exception('订单号不能为空');
                }

                if (empty($price)) {
                    throw new \Exception('价格不能为空');
                }

                $price = floatval($price);

                if ((!is_int($price) && !is_float($price)) || $price > 1000000 || $price < 0) {
                    throw new \Exception("价格错误");
                }

                $cost = floatval($cost);
                if (empty($cost)) {
                    throw new \Exception('营销成本不能为空');
                }
                if ((!is_int($cost) && !is_float($cost)) || $cost > 1000000 || $cost < 0) {
                    throw new \Exception("营销成本错误");
                }
                
                $item = \app\index\model\Item::where("id", $itemId)->find();

                if (empty($item) || $item->status != \app\index\model\Item::STATUS_NORMAL) {
                    throw new \Exception("库存物品无效");
                }

                $updated = $item->save([
                    'status' => \app\index\model\Item::STATUS_OUTGO_WAIT,
                    'update_time' => time(),
                ], [
                    'id' => $item->id,
                    'status' => \app\index\model\Item::STATUS_NORMAL
                ]);

                if ($updated != 1) {
                    throw new \Exception("库存更新失败");
                }

                $model = new ItemOutgoHistory;
                $model->data([
                    'item_id' => $itemId,
                    'date' => date('Y-m-d'),
                    'channel_id' => $channelId,
                    'order_no' => $order_no,
                    'consignee_nickname' => $consignee_nickname,
                    'consignee' => $consignee,
                    'consignee_address' => $consignee_address,
                    'consignee_phone' => $consignee_phone,
                    'price' => $price,
                    'cost' => $cost,
                    'memo' => $memo,
                    'status' => ItemOutgoHistory::STATUS_WAIT,
                    'create_user_id' => Session::get("user_id"),
                    'create_time' => time(),
                    'update_time' => time(),
                ]);

                if (!$model->save()) {
                    throw new \Exception("出库记录保存失败");
                }

                Db::commit();
                AddLog(\app\index\model\Log::ACTION_ITEM_OUTGO, json_encode($this->request->param())
                    , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
            } catch (\Exception $e) {

                DB::rollback();
                $result = SetResult(500, $e->getMessage());
                AddLog(\app\index\model\Log::ACTION_ITEM_OUTGO, json_encode($this->request->param())
                    , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
            }

        } else {
            $result = SetResult(500, '请求方式错误');
        }

        return $result;
    }

    //出库审核
    public function outgoAgree(){

        $lists = ItemOutgoHistory::where("status", ItemOutgoHistory::STATUS_WAIT)->paginate(10);

        $breadcrumb = '出库审核';

        return $this->fetch('outgo_agree', [
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    public function changeName(){

        $name = $this->request->get('name');

        if (!empty($name))  {
            $nameId = ItemName::where("data", $name)
                ->column('id');

            if (!empty($nameId)) {

                $features = ItemFeature::where("status", ItemFeature::STATUS_ACTIVE)
                ->where("name_id", 'in', $nameId)
                ->field('data')
                ->select();
        
                $networks = ItemNetwork::where("status", ItemNetwork::STATUS_ACTIVE)
                ->where("name_id", 'in', $nameId)
                ->field('data')
                ->select();
        
                $appearances = ItemAppearance::where("status", ItemAppearance::STATUS_ACTIVE)
                ->where("name_id", 'in', $nameId)
                ->field('data')
                ->select();

                $result = SetResult(200,  [
                    'features' => $features,
                    'networks' => $networks,
                    'appearances' => $appearances
                ]);
                return $result;
            }
        }
    }

    //在库查询
    public function inventory(){

        $lists = \app\index\model\Item::where("status", "in", [
            \app\index\model\Item::STATUS_NORMAL,
            \app\index\model\Item::STATUS_OUTGO_WAIT,
            \app\index\model\Item::STATUS_PREPARE
        ]);

        $typeId = $this->request->get("type_id");

        if (!empty($typeId)) {
            $typeArr = ItemType::where("status", ItemType::STATUS_ACTIVE)
            ->where("data", $typeId)
            ->column('id');
            $lists = $lists->where("type_id", 'in', $typeArr);
        }

        $nameId = $this->request->get("name_id");

        if (!empty($nameId)) {
            $nameArr = ItemName::where("status", ItemName::STATUS_ACTIVE)
            ->where("data", $nameId)
            ->column('id');
            $lists = $lists->where("name_id",  'in', $nameArr);
        }

        $featureId = $this->request->get("feature_id");

        if (!empty($featureId)) {
            $featureArr = ItemFeature::where("status", ItemFeature::STATUS_ACTIVE)
            ->where("data", $featureId)
            ->column('id');
            $lists = $lists->where("feature_id",  'in', $featureArr);
        }
        
        $networkId = $this->request->get("network_id");

        if (!empty($networkId)) {

            $networkArr = ItemNetwork::where("status", ItemNetwork::STATUS_ACTIVE)
            ->where("data", $networkId)
            ->column('id');

            $lists = $lists->where("network_id", 'in',  $networkArr);
        }

        $appearanceId = $this->request->get("appearance_id");

        if (!empty($appearanceId)) {

            $appearanceArr = ItemAppearance::where("status", ItemAppearance::STATUS_ACTIVE)
            ->where("data", $appearanceId)
            ->column('id');

            $lists = $lists->where("appearance_id",  'in', $appearanceArr);
        }

        $keyword = $this->request->get("keyword");

        if (!empty($keyword) && $keyword > 0) {
            $lists = $lists->where("number",  "LIKE",  "%".$keyword."%");
        }

        $lists = $lists->paginate(10);

        foreach ($lists as $list) {
            $list->statusName = $list->getStatusName();
        }

        $typeIds = Db::table('y5g_item')->distinct(true)->field("type_id")->select();

        if (!empty($typeIds)) {
            $types = ItemType::where("id", 'in', array_column($typeIds, 'type_id'))->distinct(true)->field('data')->select();
        } else {
            $types = [];
        }

        $nameIds = Db::table('y5g_item')->distinct(true)->field("name_id")->select();
    
        if (!empty($nameIds)) {
            $names = ItemName::where("id", 'in', array_column($nameIds, 'name_id'))->distinct(true)->field('data')->select();
        } else {
            $names = [];
        }

        $featureIds = Db::table('y5g_item')->distinct(true)->field("feature_id")->select();

        if (!empty($featureIds)) {
            $features = ItemFeature::where("id", 'in', array_column($featureIds, 'feature_id'))->distinct(true)->field('data')->select();
  
        } else {
            $features = [];
        }

        $networkIds = Db::table('y5g_item')->distinct(true)->field("network_id")->select();
        if (!empty($networkIds)) {

            $networks = itemNetwork::where("id", 'in', array_column($networkIds, 'network_id'))->distinct(true)->field('data')->select();
        } else {
            $networks = [];
        }

        $appearanceIds = Db::table('y5g_item')->distinct(true)->field("appearance_id")->select();

        if (!empty($appearanceIds)) {
            $appearances = ItemAppearance::where("id", 'in', array_column($appearanceIds, 'appearance_id'))->distinct(true)->field('data')->select();
        } else {
            $appearances = [];
        }

        $breadcrumb = '在库查询';

        AddLog(\app\index\model\Log::ACTION_ITEM_INVENTORY, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $this->fetch('inventory', [
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
            'types' => $types,
            'names' => $names,
            'features' => $features,
            'networks' => $networks,
            'appearances' => $appearances,
            'data' =>  [
                'features' => $features,
                'networks' => $networks,
                'appearances' => $appearances
            ]
        ]);
    }

    // 预售
    public function prepare(){
        
        $result = SetResult(200, '操作成功');
        $id = $this->request->post("id");
        $info = $this->request->post("prepare");

        if ($id){
            $item = \app\index\model\Item::where("id", $id)->find();

            if (empty($item)) {
                $result = SetResult(500, '数据异常');
            } elseif ($item->status != \app\index\model\Item::STATUS_NORMAL) {
                $result = SetResult(500, '状态异常');
            } else {
                
                $item->status = \app\index\model\Item::STATUS_PREPARE;
                $item->memo = $info;
                $item->update_time = time();
                if (!$item->save()) {
                    $result = SetResult(500, '操作失败');
                }
            }

        } else {
            $result = SetResult(500, 'id错误');
        }

        return $result;
    }

    // 取消预售
    public function cancelPrepare(){
        $result = SetResult(200, '操作成功');
        $id = $this->request->post("id");

        if ($id){
            $item = \app\index\model\Item::where("id", $id)->find();
            if (empty($item)) {
                $result = SetResult(500, '数据异常');
            } elseif ($item->status != \app\index\model\Item::STATUS_PREPARE) {
                $result = SetResult(500, '状态异常');
            } else {
                $item->status = \app\index\model\Item::STATUS_NORMAL;
                $item->memo = '';
                $item->update_time = time();
                if (!$item->save()) {
                    $result = SetResult(500, '操作失败');
                }
            }
        } else {
            $result = SetResult(500, 'id错误');
        }

        return $result;
    }

    //综合查询
    public function search(){
        $lists = \app\index\model\Item::where('id', '>', '0');

        $typeId = $this->request->get("type_id");

        if (!empty($typeId)) {
            $typeArr = ItemType::where("status", ItemType::STATUS_ACTIVE)
                ->where("data", $typeId)
                ->column('id');
            $lists = $lists->where("type_id",  'in', $typeArr);
        }

        $nameId = $this->request->get("name_id");

        if (!empty($nameId)) {
            $nameArr = ItemName::where("status", ItemName::STATUS_ACTIVE)
            ->where("data", $nameId)
            ->column('id');
            $lists = $lists->where("name_id",  'in', $nameArr);
        }

        $featureId = $this->request->get("feature_id");

        if (!empty($featureId)) {
            $featureArr = ItemFeature::where("status", ItemFeature::STATUS_ACTIVE)
            ->where("data", $featureId)
            ->column('id');
            
            $lists = $lists->where("feature_id",  'in',  $featureArr);
        }

        $networkId = $this->request->get("network_id");

        if (!empty($networkId)) {

            $networkArr = ItemNetwork::where("status", ItemNetwork::STATUS_ACTIVE)
            ->where("data", $networkId)
            ->column('id');

            $typeArr2 = ItemType::where("network_id" ,  'in',  $networkArr)->field("id")->select();
            $lists = $lists->where("type_id", 'in',  array_column($typeArr2, 'id'));
        }

        $appearanceId = $this->request->get("appearance_id");

        if (!empty($appearanceId)) {

            $appearanceArr = ItemAppearance::where("status", ItemAppearance::STATUS_ACTIVE)
            ->where("data", $appearanceId)
            ->column('id');
            $lists = $lists->where("appearance_id",  'in', $appearanceArr);
        }

        $categoryId = $this->request->get("category_id");

        if (!empty($categoryId)) {
            $categoryArr = ItemCategory::where("status", ItemCategory::STATUS_ACTIVE)
            ->where("data", $categoryId)
            ->column('id');
            $lists = $lists->where("category_id",  'in', $categoryArr);
        }

        $editionId = $this->request->get("edition_id");

        if (!empty($editionId)) {
            $editionArr = ItemEdition::where("status", ItemEdition::STATUS_ACTIVE)
            ->where("data", $editionId)
            ->column('id');
            $lists = $lists->where("edition_id",  'in', $editionArr);
        }

        $channelId = $this->request->get("channel_id");

        if (!empty($channelId)) {
            $channelArr = ItemChannel::where("status", ItemChannel::STATUS_ACTIVE)
            ->where("data", $channelId)
            ->column('id');
            $lists = $lists->where("channel_id",  'in', $channelArr);
        }

        $date = $this->request->get("date");

        if (!empty($date) && $date > 0) {
            $lists = $lists->where("date", $date);
        }

        $status = $this->request->get("status");

        if (!empty($status) && $status > 0) {
            $lists = $lists->where("status", $status);
        }

        $keyword = $this->request->get("keyword");

        if (!empty($keyword) && $keyword > 0) {
            $lists = $lists->where("number",  "LIKE",  "%".$keyword."%");
        }

        $lists = $lists->paginate(10);

        foreach ($lists as $list) {
            $list->statusName = $list->getStatusName();
        }

        $types = ItemType::where("status", ItemType::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $names = ItemName::where("status", ItemName::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $features = ItemFeature::where("status", ItemFeature::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $appearances = ItemAppearance::where("status", ItemAppearance::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $networks = itemNetwork::where("status", ItemNetwork::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $categories = ItemCategory::where("status",  ItemCategory::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $editions = ItemEdition::where("status",  ItemEdition::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $channels = ItemChannel::where("status",  ItemChannel::STATUS_ACTIVE)->distinct(true)->field('data')->select();

        $dates = Db::table('y5g_item')->distinct(true)->field("date")->select();

        $dates = array_column($dates, 'date');

        $model = new \app\index\model\Item;

        $statuses = $model->getStatusOptions();

        $breadcrumb = '综合查询';

        AddLog(\app\index\model\Log::ACTION_ITEM_SEARCH, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $this->fetch('search', [
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
            'types' => $types,
            'names' => $names,
            'features' => $features,
            'networks'  => $networks,
            'appearances' => $appearances,
            'categories' => $categories,
            'editions' => $editions,
            'channels' => $channels,
            'dates' => $dates,
            'statuses' => $statuses,
            'data' =>  [
                'features' => $features,
                'networks' => $networks,
                'appearances' => $appearances
            ]
        ]);
    }

    //通过出库审核
    public function allowOutgoAgree(){

        $result = SetResult(200, '保存成功');

        $id = $this->request->param('id');

        Db::startTrans();
        try {

            if ( empty($id)) {
                throw new \Exception("id不能为空");
            }

            $history = ItemOutgoHistory::where("id", $id)->find();

            if (empty($history) || $history->status != ItemOutgoHistory::STATUS_WAIT) {
                throw new \Exception("出库记录无效");
            }

            $updated = $history->save([
                'status' => ItemOutgoHistory::STATUS_SUCCESS,
                'update_time' => time(),
            ], [
                'id' => $history->id,
                'status' => ItemOutgoHistory::STATUS_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("出库记录更新失败");
            }

            $item = $history->item;

            if (empty($item) || $item->status != \app\index\model\Item::STATUS_OUTGO_WAIT) {
                throw new \Exception("库存记录无效");
            }

            $updated = $item->save([
                'status' => \app\index\model\Item::STATUS_SOLD,
                'update_time' => time()
            ], [
                'id' => $item->id,
                'status' =>  \app\index\model\Item::STATUS_OUTGO_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("库存记录更新失败");
            }

            Db::commit();
            AddLog(\app\index\model\Log::ACTION_ITEM_OUTGO_AGREE_SUCCESS, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            Db::rollback();
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_ITEM_OUTGO_AGREE_SUCCESS, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //拒绝出库审核
    public function rejectOutgoAgree(){
        $result = SetResult(200, '操作成功');

        $id = $this->request->param('id');

        Db::startTrans();
        try {

            if ( empty($id)) {
                throw new \Exception("id不能为空");
            }

            $history = ItemOutgoHistory::where("id", $id)->find();

            if (empty($history) || $history->status != ItemOutgoHistory::STATUS_WAIT) {
                throw new \Exception("出库记录无效");
            }

            $updated = $history->save([
                'status' => ItemOutgoHistory::STATUS_FAIL,
                'update_time' => time(),
            ], [
                'id' => $history->id,
                'status' => ItemOutgoHistory::STATUS_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("出库记录更新失败");
            }

            $item = $history->item;

            if (empty($item) || $item->status != \app\index\model\Item::STATUS_OUTGO_WAIT) {
                throw new \Exception("库存记录无效");
            }

            $updated = $item->save([
                'status' => \app\index\model\Item::STATUS_NORMAL,
                'update_time' => time(),
            ], [
                'id' => $item->id,
                'status' => \app\index\model\Item::STATUS_OUTGO_WAIT
            ]);

            if ($updated != 1) {
                throw new \Exception("库存记录更新失败");
            }

            Db::commit();
            AddLog(\app\index\model\Log::ACTION_ITEM_OUTGO_AGREE_REJECT, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            Db::rollback();
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_ITEM_OUTGO_AGREE_REJECT, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

}