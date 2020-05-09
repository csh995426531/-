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

}