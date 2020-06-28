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

    public function _initialize()
    {

        $this->checkLogin();
    }

    protected function checkLogin()
    {

        $module = strtolower($this->request->module());
        $controller = strtolower($this->request->controller());
        $action = strtolower($this->request->action());
        $uri = $module . '/' . $controller . '/' . $action;

        if (!in_array($uri, ["index/index/login", "index/index/logout", "index/index/captcha_src"])) {

            $userId = Session::get("user_id");

            if (empty($userId)) {
                $this->redirect("/login");
            }

            if (!in_array($controller, ['popup'])) {
                $this->checkRules($uri);
            }
        }
    }

    protected function checkRules($uri)
    {

        $userId = Session::get('user_id');
        $userNodes = UserAccess::where('user_id', $userId)
            ->where("status", UserAccess::STATUS_ACTIVE)
            ->select();

        $nodes = ['index/index/index', 'index/index/home', "index/index/executsql"
            , 'index/statistics/index', 'index/item/changename', 'index/item/changecategory'
            , "index/index/errortemp"];
        if (!empty($userNodes)) {
            $userNodesTemp = collection($userNodes)->toArray();

            $accessNodesTemp = AccessNode::where("id", 'in', array_column($userNodesTemp, 'node_id'))->select();
            $accessNode = new AccessNode;
            $nodeChildren = $accessNode->getNodeChildren();

            foreach ($accessNodesTemp as $temp) {

                $str = $temp->module . '/' . $temp->controller . '/' . $temp->action;

                if (isset($nodeChildren[$str])) {

                    $nodes = array_merge($nodes, $nodeChildren[$str]);
                } else {
                    $nodes[] = $str;
                }
            }
        }

        if (!in_array($uri, $nodes)) {
            $this->redirect("/error", ['message' => '您没有访问权限!']);die;
        }

    }
}
