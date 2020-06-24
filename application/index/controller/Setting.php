<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/30
 * Time: 16:48
 */
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\ItemAppearance;
use app\index\model\ItemCategory;
use app\index\model\ItemChannel;
use app\index\model\ItemEdition;
use app\index\model\ItemFeature;
use app\index\model\ItemName;
use app\index\model\ItemType;
use app\index\model\ItemNetwork;
use app\index\model\ItemIntelligence;
use app\index\model\ItemHistory;
use app\index\model\ItemIncomeHistory;
use app\index\model\ItemOutgoHistory;
use app\index\service\Item as ItemService;
use app\index\model\User;
use think\Session;
use think\Db;

class Setting extends BaseController
{
    //类别
    public function category($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }

        $breadcrumb = '类别录入';
        return $this->fetch("category", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //类别-列表数据
    public function categoryList(){
        $limit = $this->request->param('limit', 10);
        return ItemCategory::order('id desc')->paginate($limit, false, ['query'=>request()->param() ]);
    }

    //增加类别
    public function addCategory() {

        $result = SetResult(200, '保存成功');

        $data = $this->request->param('data');

        try {

            if (empty($data)) {
                throw new \Exception("值不能为空");
            }

            $id = $this->request->param('id', 0);

            $category = ItemCategory::where([
                "data" => ['=', $data],
                'id' => ['<>', $id]
            ])->find();

            if (!empty($category)) {
                throw new \Exception("该类别已存在");
            }

            $model = new ItemCategory;

            if ($id) {
                if (!$model->update([
                    'id' => $id,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                }
            } else {
                $model->data([
                    'data' => $data,
                    'status' => ItemCategory::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_CATEGORY_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_CATEGORY_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用类别
    public function delCategory() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $category = ItemCategory::where("id", $id)->find();

        if ($category->status != ItemCategory::STATUS_ACTIVE) {
            $result = SetResult(500, '已停用');
        }

        $category->status = ItemCategory::STATUS_INVALID;
        $category->update_time = time();

        if (!$category->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_CATEGORY_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用类别
    public function openCategory() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $category = ItemCategory::where("id", $id)->find();

        if ($category->status != ItemCategory::STATUS_INVALID) {
            $result = SetResult(500, '已启用');
        }

        $category->status = ItemCategory::STATUS_ACTIVE;
        $category->update_time = time();

        if (!$category->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }

    //名称
    public function name($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '名称录入';

        return $this->fetch("name", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //名称-列表数据
    public function nameList(){
        $limit = $this->request->param('limit', 10);
        $lists = ItemName::order('id desc')->paginate($limit, false, ['query'=>request()->param() ]);
        foreach ($lists as &$list) {
            $list->category = $list->category;
        }
        return $lists;
    }

    //增加名称
    public function addName(){

        $result = SetResult(200, '保存成功');

        $categoryId = $this->request->param('category_id');

        $data = $this->request->param('data');

        try {

            if ( empty($categoryId)) {
                throw new \Exception("类别不能为空");
            }

            if ( empty($data)) {
                throw new \Exception("值不能为空");
            }

            $category = ItemCategory::where("id", $categoryId)->find();

            if (empty($category) || $category->status != ItemCategory::STATUS_ACTIVE) {
                throw new \Exception("类别无效");
            }

            $id = $this->request->param('id', 0);

            $name = ItemName::where([
                "data" => ['=', $data],
                "id" => ['<>', $id],
            ])->find();

            if (!empty($name)) {
                throw new \Exception("该名称已存在");
            }

            $model = new ItemName;

            if ($id) {
                if (!$model->update([
                    'id' => $id,
                    'category_id' => $categoryId,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                }
            } else {
                $model->data([
                    'category_id' => $categoryId,
                    'data' => $data,
                    'status' => ItemName::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_NAME_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_NAME_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用名称
    public function delName() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $name = ItemName::where("id", $id)->find();

        if ($name->status != ItemName::STATUS_ACTIVE) {
            $result = SetResult(500, '已停用');
        }

        $name->status = ItemName::STATUS_INVALID;
        $name->update_time = time();

        if (!$name->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_NAME_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用名称
    public function openName() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $name = ItemName::where("id", $id)->find();

        if ($name->status != ItemName::STATUS_INVALID) {
            $result = SetResult(500, '已启用');
        }

        $name->status = ItemName::STATUS_ACTIVE;
        $name->update_time = time();

        if (!$name->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }

    //配置
    public function feature($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '配置录入';

        return $this->fetch("feature", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //配置-列表数据
    public function featureList(){
        $limit = $this->request->param('limit', 10);
        $lists = ItemFeature::order('id desc')->paginate($limit, false, ['query'=>request()->param() ]);
        foreach ($lists as &$list) {
            $list->category = $list->category;
            $list->itemName = $list->itemName;
        }
        return $lists;
    }

    //增加配置
    public function addFeature(){

        $result = SetResult(200, '保存成功');

        $nameId = $this->request->param('name_id');

        $data = $this->request->param('data');

        try {

            if ( empty($nameId)) {
                throw new \Exception("名称不能为空");
            }

            if ( empty($data)) {
                throw new \Exception("值不能为空");
            }

            $name = ItemName::where("id", $nameId)->find();

            if (empty($name) || $name->status != ItemName::STATUS_ACTIVE) {
                throw new \Exception("名称无效");
            }

            $id = $this->request->param('id');

            $feature = ItemFeature::where([
                "data" => ['=', $data],
                'name_id' => ['=', $nameId],
                "id" => ['<>', $id],
            ])->find();

            if (!empty($feature)) {
                throw new \Exception("该配置已存在");
            }

            $model = new ItemFeature;
            $model->data([
                'category_id' => $name->category_id,
                'name_id' => $nameId,
                'data' => $data,
                'status' => ItemFeature::STATUS_ACTIVE,
                'create_time' => time(),
                'update_time' => time()
            ]);

            if ($id) {
                if (!$model->update([
                    'id' => $id,
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                }
            } else {
                $model->data([
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'data' => $data,
                    'status' => ItemFeature::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_FEATURE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_FEATURE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用配置
    public function delFeature() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $feature = ItemFeature::where("id", $id)->find();

        if ($feature->status != ItemFeature::STATUS_ACTIVE) {
            $result = SetResult(500, '不可重复停用');
        }

        $feature->status = ItemFeature::STATUS_INVALID;
        $feature->update_time = time();

        if (!$feature->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_FEATURE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用配置
    public function openFeature() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $feature = ItemFeature::where("id", $id)->find();

        if ($feature->status != ItemFeature::STATUS_INVALID) {
            $result = SetResult(500, '不可重复启用');
        }

        $feature->status = ItemFeature::STATUS_ACTIVE;
        $feature->update_time = time();

        if (!$feature->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }

    //外观
    public function appearance($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '外观录入';

        return $this->fetch("appearance", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //外观-列表数据
    public function appearanceList(){
        $limit = $this->request->param('limit', 10);
        $lists = ItemAppearance::order('id desc')->paginate($limit, false, ['query'=>request()->param() ]);
        foreach ($lists as &$list) {
            $list->category = $list->category;
            $list->itemName = $list->itemName;
        }
        return $lists;
    }

    //增加外观
    public function addAppearance(){

        $result = SetResult(200, '保存成功');

        $nameId = $this->request->param('name_id');

        $data = $this->request->param('data');

        try {

            if ( empty($nameId)) {
                throw new \Exception("名称不能为空");
            }

            if ( empty($data)) {
                throw new \Exception("值不能为空");
            }

            $name = ItemName::where("id", $nameId)->find();

            if (empty($name) || $name->status != ItemName::STATUS_ACTIVE) {
                throw new \Exception("名称无效");
            }


            $id = $this->request->param('id');

            $appearance = ItemAppearance::where([
                'id' => ['<>', $id],
                'data' => ['=', $data],
                'name_id' => ['=', $nameId]
            ])->find();

            if (!empty($appearance)) {
                throw new \Exception("该外观已存在");
            }

            $model = new ItemAppearance;

            if ($id) {

                if (!$model->update([
                    'id' => $id,
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                };

            } else {
                $model->data([
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'data' => $data,
                    'status' => ItemAppearance::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_APPEARANCE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_APPEARANCE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用外观
    public function delAppearance() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $appearance = ItemAppearance::where("id", $id)->find();

        if ($appearance->status != ItemAppearance::STATUS_ACTIVE) {
            $result = SetResult(500, '不可重复停用');
        }

        $appearance->status = ItemAppearance::STATUS_INVALID;
        $appearance->update_time = time();

        if (!$appearance->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_APPEARANCE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用外观
    public function openAppearance() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $appearance = ItemAppearance::where("id", $id)->find();

        if ($appearance->status != ItemAppearance::STATUS_INVALID) {
            $result = SetResult(500, '不可重复启用');
        }

        $appearance->status = ItemAppearance::STATUS_ACTIVE;
        $appearance->update_time = time();

        if (!$appearance->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }

    //固件版本
    public function edition($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '固件版本录入';

        return $this->fetch("edition", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //固件版本-列表数据
    public function editionList(){
        $limit = $this->request->param('limit', 10);
        $lists = ItemEdition::order('id desc')->paginate($limit, false, ['query'=>request()->param() ]);
        foreach ($lists as &$list) {
            $list->category = $list->category;
            $list->itemName = $list->itemName;
        }
        return $lists;
    }

    //增加固件版本
    public function addEdition(){

        $result = SetResult(200, '保存成功');

        $categoryId = $this->request->param('category_id');

        $data = $this->request->param('data');

        try {

            if ( empty($categoryId)) {
                throw new \Exception("类别不能为空");
            }

            if ( empty($data)) {
                throw new \Exception("值不能为空");
            }

            $category = ItemCategory::where("id", $categoryId)->find();

            if (empty($category) || $category->status != ItemCategory::STATUS_ACTIVE) {
                throw new \Exception("类别无效");
            }

            $id = $this->request->param('id');

            $edition = ItemEdition::where([
                'id' => ['<>', $id],
                'data' => ['=', $data],
                'category_id' => ['=', $categoryId],
            ])->find();

            if (!empty($edition)) {
                throw new \Exception("该类别下固件版本已存在");
            }

            $model = new ItemEdition;

            if ($id) {
                if (!$model->update([
                    'id' => $id,
                    'category_id' => $categoryId,
                    'name_id' => 0,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    if (!$model->save()) {
                        throw new \Exception("保存错误");
                    }
                }
            } else {

                $model->data([
                    'category_id' => $categoryId,
                    'name_id' => 0,
                    'data' => $data,
                    'status' => ItemEdition::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_EDITION_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_EDITION_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用固件版本
    public function delEdition() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $edition = ItemEdition::where("id", $id)->find();

        if ($edition->status != ItemEdition::STATUS_ACTIVE) {
            $result = SetResult(500, '不可重复停用');
        }

        $edition->status = ItemEdition::STATUS_INVALID;
        $edition->update_time = time();

        if (!$edition->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_EDITION_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用固件版本
    public function openEdition() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $edition = ItemEdition::where("id", $id)->find();

        if ($edition->status != ItemEdition::STATUS_INVALID) {
            $result = SetResult(500, '不可重复启用');
        }

        $edition->status = ItemEdition::STATUS_ACTIVE;
        $edition->update_time = time();

        if (!$edition->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }

    //型号
    public function type($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '网络模式型号录入';

        return $this->fetch("type", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //型号-列表数据
    public function typeList(){
        $limit = $this->request->param('limit', 10);
        $lists = ItemType::order('id desc')->paginate($limit, false, ['query'=>request()->param() ]);
        foreach ($lists as &$list) {
            $list->category = $list->category;
            $list->itemName = $list->itemName;
            $list->itemNetwork = $list->itemNetwork;
        }
        return $lists;
    }

    //增加型号
    public function addType(){

        $result = SetResult(200, '保存成功');

        $nameId = $this->request->param('name_id');

        $network_data = $this->request->param('network');

        $data = $this->request->param('data');

        try {

            if ( empty($nameId)) {
                throw new \Exception("名称不能为空");
            }

            if ( empty($network_data)) {
                throw new \Exception("网络模式不能为空");
            }

            if ( empty($data)) {
                throw new \Exception("型号不能为空");
            }

            $name = ItemName::where("id", $nameId)->find();

            if (empty($name) || $name->status != ItemName::STATUS_ACTIVE) {
                throw new \Exception("名称无效");
            }

            $id = $this->request->param('id', 0);

            $type = ItemType::where([
                "data" => ['=', $data],
                "id" => ['<>', $id],
            ])->find();

            if (!empty($type)) {
                throw new \Exception("该型号已存在");
            }

            $network = ItemNetwork::where([
                "data" => $network_data,
                'name_id' => $nameId
            ])->find();

            if (empty($network) ) {
                $network = new ItemNetwork;
                
                $network->data([
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'data' => $network_data,
                    'status' => ItemNetwork::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$network->save()) {
                    throw new \Exception("保存错误");
                }
            }

            $model = new ItemType;
            
            if (!empty($id)) {
    
                if (!$model->update([
                    'id' => $id,
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'network_id' => $network->id,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                }
            } else {
                $model->data([
                    'category_id' => $name->category_id,
                    'name_id' => $nameId,
                    'network_id' => $network->id,
                    'data' => $data,
                    'status' => ItemType::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_TYPE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_TYPE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用型号
    public function delType() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $edition = ItemType::where("id", $id)->find();

        if ($edition->status != ItemType::STATUS_ACTIVE) {
            $result = SetResult(500, '不可重复停用');
        }

        $edition->status = ItemType::STATUS_INVALID;
        $edition->update_time = time();

        if (!$edition->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_TYPE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        return $result;
    }

    //启用型号
    public function openType() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $edition = ItemType::where("id", $id)->find();

        if ($edition->status != ItemType::STATUS_INVALID) {
            $result = SetResult(500, '不可重复启用');
        }

        $edition->status = ItemType::STATUS_ACTIVE;
        $edition->update_time = time();

        if (!$edition->save()) {
            $result = SetResult(500, '启用失败');
        }
        return $result;
    }

    //渠道
    public function incomeChannel($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '渠道录入';
        return $this->fetch("income_channel", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //渠道-列表数据
    public function incomeChannelList(){
        $limit = $this->request->param('limit', 10);
        $type = $this->request->param('type', 0);
        if ($type > 0) {
            $lists = ItemChannel::where('type', $type)->paginate($limit, false, ['query'=>request()->param()]);
        } else {
            $lists = ItemChannel::paginate($limit, false, ['query'=>request()->param()]);
        }

        $itemChannel = new ItemChannel; 
        foreach ($lists as &$list) {
            $list['type_name'] = $itemChannel->formatTypeName($list->type);
        }
        return $lists;
    }

    //出货途径
    public function outgoChannel($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $lists = ItemChannel::where("type", ItemChannel::TYPE_OUTGO)
            ->paginate(10, false, ['query'=>request()->param() ]);
        $breadcrumb = '出货途径录入';

        return $this->fetch("outgo_channel", [
            'message' => $message,
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //增加渠道
    public function addChannel() {

        $result = SetResult(200, '保存成功');
        $data = $this->request->param('data');
        $type = $this->request->param('type');

        try {

            if (empty($data)) {
                throw new \Exception("值不能为空");
            }
            if (empty($type)) {
                throw new \Exception("渠道类型错误");
            }

            $id = $this->request->param('id');
            $category = ItemChannel::where([
                "id" => ['<>', $id],
                "type" => ['=', $data],
                "data" => ['=', $data]
            ])->find();
            if (!empty($category)) {
                throw new \Exception("该渠道已存在");
            }

            $model = new ItemChannel;
            if ($id) {  
                if (!$model->update([
                    'id' => $id,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                }
            } else {
                $model->data([
                    'data' => $data,
                    'type' => $type,
                    'status' => ItemChannel::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_CHANNEL_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_CHANNEL_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用渠道
    public function delChannel() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $channel = ItemChannel::where("id", $id)->find();

        if ($channel->status != ItemChannel::STATUS_ACTIVE) {
            $result = SetResult(500, '不可重复停用');
        }

        $channel->status = ItemChannel::STATUS_INVALID;
        $channel->update_time = time();

        if (!$channel->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_CHANNEL_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用渠道
    public function openChannel() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $channel = ItemChannel::where("id", $id)->find();

        if ($channel->status != ItemChannel::STATUS_INVALID) {
            $result = SetResult(500, '不可重复启用');
        }

        $channel->status = ItemChannel::STATUS_ACTIVE;
        $channel->update_time = time();

        if (!$channel->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }    

    //网络模式
    public function network($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }

        $nameData = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();

        $names = [];

        foreach ($nameData as $nameTemp) {

            if (!isset($names[$nameTemp->category_id])) {
                $names[$nameTemp->category_id]['category'] = $nameTemp->category;
            }

            $names[$nameTemp->category_id]['lists'][] = $nameTemp;
        }
        
        $itemNames = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();

        $lists = ItemNetwork::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '网络模式录入';

        return $this->fetch("network", [
            'message' => $message,
            'lists' => $lists,
            'names' => $names,
            'itemNames' => $itemNames,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //添加网络模式
    public function addNetwork(){
   
        $result = SetResult(200, '保存成功');

        $nameId = $this->request->param('name_id');

        $data = $this->request->param('data');

        try {

            if ( empty($nameId)) {
                throw new \Exception("名称不能为空");
            }

            if ( empty($data)) {
                throw new \Exception("值不能为空");
            }

            $name = ItemName::where("id", $nameId)->find();

            if (empty($name) || $name->status != ItemName::STATUS_ACTIVE) {
                throw new \Exception("名称无效");
            }

            $network = ItemNetwork::where("data", $data)
                ->where("category_id", $name->category_id)
                ->where("name_id", $nameId)
                ->find();

            if (!empty($network)) {
                throw new \Exception("该网络模式已存在");
            }

            $model = new ItemNetwork;
            $model->data([
                'category_id' => $name->category_id,
                'name_id' => $nameId,
                'data' => $data,
                'status' => ItemNetwork::STATUS_ACTIVE,
                'create_time' => time(),
                'update_time' => time()
            ]);

            if (!$model->save()) {
                throw new \Exception("保存错误");
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_NAME_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_NAME_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }
        
        return $result;
    }

    //停用网络模式
    public function delNetwork() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $name = ItemNetwork::where("id", $id)->find();

        if ($name->status != ItemNetwork::STATUS_ACTIVE) {
            $result = SetResult(500, '已停用');
        }

        $name->status = ItemNetwork::STATUS_INVALID;
        $name->update_time = time();

        if (!$name->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_NAME_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //启用网络模式
    public function openNetwork() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $name = ItemNetwork::where("id", $id)->find();

        if ($name->status != ItemNetwork::STATUS_INVALID) {
            $result = SetResult(500, '已启用');
        }

        $name->status = ItemNetwork::STATUS_ACTIVE;
        $name->update_time = time();

        if (!$name->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }

    /**
     * 特殊修改
     *
     * @return void
     * @author CSH <1114313879@qq.com>
     */
    public function specialEditItemList()
    {
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

        $breadcrumb = '特殊修改';

        return $this->fetch('special_edit_item_list', [
            'users' => $users,
            'userId' => Session::get("user_id"),
            'names' => $names,
            'channels' => $channels,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    /**
     * 特殊修改-列表数据
     *
     * @return void
     * @author CSH <1114313879@qq.com>
     */
    public function specialEditItemLists(){

        $this->request->get(['status'=>[
            \app\index\model\Item::STATUS_NORMAL,
            \app\index\model\Item::STATUS_OUTGO_WAIT
        ]]);
        $lists = (new ItemService)->getList(array_merge($this->request->get(false), $this->request->get(false)));

        return $lists;
    }

    //特殊修改编辑保存
    public function specialEditItem(){
        $id = $this->request->get('id');
        if ($id) {
            $history = ItemIncomeHistory::where('id', $id)->find();
        }

        if ($this->request->isPost()) {

            $date = $this->request->post("date");
            $typeId = $this->request->post("type_id");
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

                if (empty($typeId)) {
                    throw new \Exception("型号不能为空");
                }

                $type = ItemType::where("data", $typeId)->find();

                if (empty($type) || $type->status != ItemType::STATUS_ACTIVE) {
                    throw new \Exception("型号无效");
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

                $number = strtoupper($number);

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
                        \app\index\model\Item::STATUS_PREPARE,
                        \app\index\model\Item::STATUS_LOSE,
                        ])
                    ->find();

                if (!empty($item) && empty($history)) {
                    throw new \Exception("序列号重复");
                } elseif (!empty($item) && !empty($history) && $item->id != $history->item->id) {
                    throw new \Exception("序列号重复");
                }
              
                if (!empty($typeId) && $typeId !== 0) {
                    $type = ItemType::where("status", ItemType::STATUS_ACTIVE)
                    ->where("data", $typeId)
                    ->find();
                    
                    $typeId = $type->id;
                }
                
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
                    "update_time" => time()
                ], ['id' => $history->item->id]);

                if (!$updated) {
                    throw new \Exception("库存更新失败");
                }

                $history = ItemIncomeHistory::where('id', $id)->find();

                Db::commit();
                $message = Message('', true);
                ItemService::getInstance()->createHistory($item->id, ItemHistory::EVENT_SPECIAL_EDIT, $history->id, 1, Session::get('user_id'));
            } catch (\Exception $e) {
                Db::rollback();
                $message = Message($e->getMessage(), false);
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
                "category_id" => $name->category_id,
                "status" => ItemEdition::STATUS_ACTIVE
            ])->select();
        }

        // var_dump($names);die;
        $channels = ItemChannel::where("type", ItemChannel::TYPE_INCOME)
            ->where("status", ItemChannel::STATUS_ACTIVE)
            ->select();
        
        $breadcrumb = '特殊修改';

        return $this->fetch('special_edit_item', [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
            'names' => $names,
            'channels' => $channels,
            'history' => $history,
        ]);
    }

    // 智能识别码
    public function intelligence($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }
        $breadcrumb = '智能识别码录入';

        return $this->fetch("intelligence", [
            'message' => $message,
            'breadcrumb' => $breadcrumb,
        ]);
    }

    //智能标识码-列表数据
    public function intelligenceList(){

        $limit = $this->request->param('limit', 10);
        $lists = ItemIntelligence::paginate($limit, false, ['query'=>request()->param() ]);
        foreach ($lists as &$list) {
            $list->itemFeature = $list->itemFeature;
            $list->itemAppearance = $list->itemAppearance;
            $list->itemType = $list->itemType;
            if ($list->itemType) {
                $list->itemType->category = $list->itemType->category;
                $list->itemType->itemName = $list->itemType->itemName;
                $list->itemType->itemNetwork = $list->itemType->itemNetwork;
            }
        }
        return $lists;
    }

    //增加智能标识码
    public function addIntelligence(){

        $result = SetResult(200, '保存成功');
        $typeId = $this->request->param('type_id');
        $featureId = $this->request->param('feature_id');
        $appearanceId = $this->request->param('appearance_id');
        $data = $this->request->param('data');

        try {

            if ( empty($typeId)) {
                throw new \Exception("型号不能为空");
            }
            if ( empty($featureId)) {
                throw new \Exception("配置不能为空");
            }
            if ( empty($appearanceId)) {
                throw new \Exception("外观不能为空");
            }
            if ( empty($data)) {
                throw new \Exception("标识码不能为空");
            }

            $type = ItemType::where("id", $typeId)->find();
            if (empty($type) || $type->status != ItemType::STATUS_ACTIVE) {
                throw new \Exception("型号无效");
            }
            $feature = ItemFeature::where("id", $featureId)->find();
            if (empty($feature) || $feature->status != ItemFeature::STATUS_ACTIVE) {
                throw new \Exception("配置无效");
            }
            $appearance = ItemAppearance::where("id", $appearanceId)->find();
            if (empty($appearance) || $appearance->status != ItemAppearance::STATUS_ACTIVE) {
                throw new \Exception("外观无效");
            }

            $id = $this->request->param('id', 0);

            $type = ItemType::where([
                "data" => ['=', $data],
                "id" => ['<>', $id],
            ])->find();

            if (!empty($type)) {
                throw new \Exception("该标识码已存在");
            }

            $model = new ItemIntelligence;
            
            if (!empty($id)) {
    
                if (!$model->update([
                    'id' => $id,
                    'type_id' => $typeId,
                    'feature_id' => $featureId,
                    'appearance_id' => $appearanceId,
                    'data' => $data,
                    'update_time' => time()
                ])) {
                    throw new \Exception("保存错误");
                }
            } else {
                $model->data([
                    'type_id' => $typeId,
                    'feature_id' => $featureId,
                    'appearance_id' => $appearanceId,
                    'data' => $data,
                    'status' => ItemType::STATUS_ACTIVE,
                    'create_time' => time(),
                    'update_time' => time()
                ]);
    
                if (!$model->save()) {
                    throw new \Exception("保存错误");
                }
            }

            AddLog(\app\index\model\Log::ACTION_SETTING_INTELLIGENCE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        }catch (\Exception $e) {
            $result = SetResult(500, $e->getMessage());
            AddLog(\app\index\model\Log::ACTION_SETTING_INTELLIGENCE_ADD, json_encode($this->request->param())
                , \app\index\model\Log::RESPONSE_FAIL, Session::get('user_id'));
        }

        return $result;
    }

    //停用智能标识码
    public function delIntelligence() {

        $result = SetResult(200, '停用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $intelligence = ItemIntelligence::where("id", $id)->find();

        if ($intelligence->status != ItemIntelligence::STATUS_ACTIVE) {
            $result = SetResult(500, '不可重复停用');
        }

        $intelligence->status = ItemIntelligence::STATUS_INVALID;
        $intelligence->update_time = time();

        if (!$intelligence->save()) {
            $result = SetResult(500, '停用失败');
        }

        AddLog(\app\index\model\Log::ACTION_SETTING_INTELLIGENCE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        return $result;
    }

    //启用智能标识码
    public function openIntelligence() {

        $result = SetResult(200, '启用成功');

        $id = $this->request->param("id");
        if (empty($id)) {
            $result = SetResult(500, 'id不能为空');
        }

        $intelligence = ItemIntelligence::where("id", $id)->find();

        if ($intelligence->status != ItemIntelligence::STATUS_INVALID) {
            $result = SetResult(500, '不可重复启用');
        }

        $intelligence->status = ItemIntelligence::STATUS_ACTIVE;
        $intelligence->update_time = time();

        if (!$intelligence->save()) {
            $result = SetResult(500, '启用失败');
        }

        return $result;
    }
    
}