<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/29
 * Time: 19:24
 */
namespace app\base\controller;

use app\index\model\AccessNode;
use app\index\model\UserAccess;
use think\Controller;
use think\Session;

class BaseController extends Controller
{

    public function _initialize(){

        $this->checkLogin();
    }

    protected function checkLogin(){

        if (!in_array($this->request->url(), ["/login", "/index/index/logout"])) {

            $userId = Session::get("user_id");

            if (empty($userId)){
                $this->redirect("/login");
            }
            $this->checkRules();
        }
    }

    protected function checkRules(){

        $userId = Session::get('user_id');
        $userNodes = UserAccess::where('user_id', $userId)
            ->where("status", UserAccess::STATUS_ACTIVE)
            ->select();

        $nodes = ['login','index/index/logout','index/index/index', 'index/item/changename', 'index/item/changecategory'];
        if (!empty($userNodes)) {
            $userNodesTemp = collection($userNodes)->toArray();

            $accessNodesTemp = AccessNode::where("id", 'in', array_column($userNodesTemp, 'node_id'))->select();
            $accessNode = new AccessNode;
            $nodeChildren = $accessNode->getNodeChildren();

            foreach ($accessNodesTemp as $temp) {

                $str = $temp->module .'/'. $temp->controller .'/'. $temp->action;

                if (isset($nodeChildren[$str])) {

                    $nodes = array_merge($nodes, $nodeChildren[$str]);
                } else {
                    $nodes[] = $str;
                }
            }
        }

        $uri = $this->request->module() .'/'. $this->request->controller() .'/'. $this->request->action();

        if (!in_array(strtolower($uri), $nodes)){
            $this->error("权限不足", '/index/index/index');
            
            return SetResult(500, '权限不足');
        }

    }
}