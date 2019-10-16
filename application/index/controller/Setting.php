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
use think\Session;

class Setting extends BaseController
{
    //类别
    public function category($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }

        $lists = ItemCategory::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '类别录入';

        return $this->fetch("category", [
            'message' => $message,
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
        ]);
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

        AddLog(\app\index\model\Log::ACTION_SETTING_CATEGORY_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //名称
    public function name($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }

        $categories = ItemCategory::where('status', ItemCategory::STATUS_ACTIVE)->select();

        $lists = ItemName::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '名称录入';

        return $this->fetch("name", [
            'message' => $message,
            'lists' => $lists,
            'categories' => $categories,
            'breadcrumb' => $breadcrumb,
        ]);
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

        AddLog(\app\index\model\Log::ACTION_SETTING_NAME_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //配置
    public function feature($message=''){

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


        $lists = ItemFeature::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '配置录入';

        return $this->fetch("feature", [
            'message' => $message,
            'lists' => $lists,
            'names' => $names,
            'breadcrumb' => $breadcrumb,
        ]);
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

            $feature = ItemFeature::where("data", $data)
                ->where("name_id", $nameId)
                ->find();

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

            if (!$model->save()) {
                throw new \Exception("保存错误");
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

        AddLog(\app\index\model\Log::ACTION_SETTING_FEATURE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //外观
    public function appearance($message=''){

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

        $lists = ItemAppearance::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '外观录入';

        return $this->fetch("appearance", [
            'message' => $message,
            'lists' => $lists,
            'names' => $names,
            'breadcrumb' => $breadcrumb,
        ]);
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

            $appearance = ItemAppearance::where("data", $data)
                ->where("name_id", $nameId)
                ->find();

            if (!empty($appearance)) {
                throw new \Exception("该外观已存在");
            }

            $model = new ItemAppearance;
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

        AddLog(\app\index\model\Log::ACTION_SETTING_APPEARANCE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //固件版本
    public function edition($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }

        // $nameData = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();

        // $names = [];

        // foreach ($nameData as $nameTemp) {

        //     if (!isset($names[$nameTemp->category_id])) {
        //         $names[$nameTemp->category_id]['category'] = $nameTemp->category;
        //     }

        //     $names[$nameTemp->category_id]['lists'][] = $nameTemp;
        // }
        $categories = ItemCategory::where('status', ItemCategory::STATUS_ACTIVE)->select();


        $lists = ItemEdition::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '固件版本录入';

        return $this->fetch("edition", [
            'message' => $message,
            'lists' => $lists,
            'categories' => $categories,
            'breadcrumb' => $breadcrumb,
        ]);
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

            $edition = ItemEdition::where("data", $data)
                ->where("category_id", $categoryId)
                ->find();

            if (!empty($edition)) {
                throw new \Exception("该类别下固件版本已存在");
            }

            $model = new ItemEdition;
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

        AddLog(\app\index\model\Log::ACTION_SETTING_EDITION_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }

    //型号
    public function type($message=''){

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

        $lists = ItemType::paginate(10, false, ['query'=>request()->param() ]);

        $breadcrumb = '网络模式型号录入';

        return $this->fetch("type", [
            'message' => $message,
            'lists' => $lists,
            'names' => $names,
            'breadcrumb' => $breadcrumb,
        ]);
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
        }catch (\Exception $e) {return 2;
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

        AddLog(\app\index\model\Log::ACTION_SETTING_TYPE_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));
        return $result;
    }

    //进货渠道
    public function incomeChannel($message=''){

        if (!empty($message)) {
            $message = urldecode($message);
        }

        $lists = ItemChannel::paginate(10, false, ['query'=>request()->param()]);

        $itemChannel = new ItemChannel; 
        foreach ($lists as $list) {
            $list['type_name'] = $itemChannel->formatTypeName($list->type);
        }
        $breadcrumb = '渠道录入';

        return $this->fetch("income_channel", [
            'message' => $message,
            'lists' => $lists,
            'breadcrumb' => $breadcrumb,
        ]);
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

            $category = ItemChannel::where("data", $data)
                ->where("type", $type)
                ->find();

            if (!empty($category)) {
                throw new \Exception("该渠道已存在");
            }

            $model = new ItemChannel;
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

        AddLog(\app\index\model\Log::ACTION_SETTING_CHANNEL_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

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

        AddLog(\app\index\model\Log::ACTION_SETTING_NAME_DEL, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $result;
    }
}