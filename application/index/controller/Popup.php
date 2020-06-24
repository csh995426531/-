<?php
/**
 * 弹出页控制器
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/6/1
 * Time: 17:23
 */
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\ItemChannel;
use app\index\model\ItemCategory;
use app\index\model\ItemName;
use app\index\model\ItemType;
use app\index\model\ItemFeature;
use app\index\model\ItemAppearance;
use app\index\model\ItemEdition;
use app\index\model\ItemIntelligence;
use think\Db;
use think\Session;

class Popup extends BaseController
{
    //在库查询-预售
    public function prepareItem(){
        $id = $this->request->get("id");
        return $this->fetch('prepare_item', [
            'id' => $id,
        ]);
    }

    //销售出库-出库
    public function outgoItem(){
        $id = $this->request->get("id");
        $channels = ItemChannel::where("type", ItemChannel::TYPE_OUTGO)->select();
        
        return $this->fetch('outgo_item', [
            'channels' => $channels,
            'id' => $id,
        ]);
    }

    //产品类别
    public function category(){
        $id = $this->request->get("id");
        $data = ItemCategory::where("id", $id)->find();
        
        return $this->fetch('category', [
            'id' => $id,
            'data' => $data,
        ]);
    }

    //产品名称
    public function name(){
        $id = $this->request->get("id");
        $data = ItemName::where("id", $id)->find();
        $categories = ItemCategory::where('status', ItemCategory::STATUS_ACTIVE)->select();
        
        return $this->fetch('name', [
            'id' => $id,
            'data' => $data,
            'categories' => $categories
        ]);
    }

    //产品型号
    public function type(){

        $nameData = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();
        $names = [];
        foreach ($nameData as $nameTemp) {
            if (!isset($names[$nameTemp->category_id])) {
                $names[$nameTemp->category_id]['category'] = $nameTemp->category;
            }
            $names[$nameTemp->category_id]['lists'][] = $nameTemp;
        }

        $id = $this->request->get("id");
        $data = ItemType::where("id", $id)->find();
        if (!empty($data)) {
            $data->itemNetwork = $data->itemNetwork;
        }

        return $this->fetch('type', [
            'id' => $id,
            'data' => $data,
            'names' => $names,
        ]);
    }

    
    //产品配置
    public function feature(){

        $nameData = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();
        $names = [];
        foreach ($nameData as $nameTemp) {
            if (!isset($names[$nameTemp->category_id])) {
                $names[$nameTemp->category_id]['category'] = $nameTemp->category;
            }
            $names[$nameTemp->category_id]['lists'][] = $nameTemp;
        }

        $id = $this->request->get("id");
        $data = ItemFeature::where("id", $id)->find();

        return $this->fetch('feature', [
            'id' => $id,
            'data' => $data,
            'names' => $names,
        ]);
    }

    //产品外观
    public function appearance(){

        $nameData = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();
        $names = [];
        foreach ($nameData as $nameTemp) {
            if (!isset($names[$nameTemp->category_id])) {
                $names[$nameTemp->category_id]['category'] = $nameTemp->category;
            }
            $names[$nameTemp->category_id]['lists'][] = $nameTemp;
        }

        $id = $this->request->get("id");
        $data = ItemAppearance::where("id", $id)->find();

        return $this->fetch('appearance', [
            'id' => $id,
            'data' => $data,
            'names' => $names,
        ]);
    }


    //固件版本
    public function edition(){

        $categories = ItemCategory::where('status', ItemCategory::STATUS_ACTIVE)->select();

        $id = $this->request->get("id");
        $data = ItemEdition::where("id", $id)->find();

        return $this->fetch('edition', [
            'id' => $id,
            'data' => $data,
            'categories' => $categories,
        ]);
    }
    
    //渠道
    public function incomeChannel(){
        $id = $this->request->get("id");
        $data = ItemChannel::where("id", $id)->find();

        return $this->fetch('income_channel', [
            'id' => $id,
            'data' => $data,
        ]);
    }

    //智能识别码
    public function intelligence(){
        $id = $this->request->get("id");
        $data = ItemIntelligence::where("id", $id)->find();

        $nameData = ItemName::where('status', ItemName::STATUS_ACTIVE)->select();
        $names = [];
        foreach ($nameData as $nameTemp) {
            if (!isset($names[$nameTemp->category_id])) {
                $names[$nameTemp->category_id]['category'] = $nameTemp->category;
            }
            $names[$nameTemp->category_id]['lists'][] = $nameTemp;
        }

        return $this->fetch('intelligence', [
            'id' => $id,
            'data' => $data,
            'names' => $names,
        ]);
    }
}