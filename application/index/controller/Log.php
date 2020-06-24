<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/6/1
 * Time: 17:23
 */
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\User;
use think\Db;
use think\Session;

class Log extends BaseController
{
    public function index()
    {

        $createUserIds = Db::table('y5g_log')->distinct(true)->field("user_id")->select();

        if (!empty($createUserIds)) {
            $users = User::where("id", 'in', array_column($createUserIds, 'user_id'))->select();
        } else {
            $users = [];
        }

        $log = new \app\index\model\Log;
        $actions = $log->getActionOptions();
        $responses = $log->getResponseOptions();

        $breadcrumb = '日志查询';

        return $this->fetch('index', [
            'breadcrumb' => $breadcrumb,
            'users' => $users,
            'actions' => $actions,
            'responses' => $responses
        ]);
    }

    public function indexList(){

        $limit = $this->request->get("limit", 10);
        $date = $this->request->get("date");
        if (!empty($date)) {
            $date_arr = explode(' ~ ', $date);
            $startDate = $date_arr[0] ?? '';
            $endDate = $date_arr[1] ?? '';
        }
        $userId = $this->request->get('user_id');
        $action = $this->request->get("action");
        $response = $this->request->get("response");

        $sql = \app\index\model\Log::where('id', '>', 0);
        if (!empty($date) && !empty($startDate)) {
            $sql = $sql->where("create_time", '>=',  strtotime($startDate));
        }

        if (!empty($endDate) && !empty($endDate)) {
            $sql = $sql->where("create_time", '<=',  strtotime($endDate) + 86400);
        }

        if (!empty($userId) && $userId > 0) {
            $sql = $sql->where("user_id", $userId);
        }

        if (!empty($action)) {
            $sql = $sql->where("action", $action);
        }

        if (!empty($response)) {
            $sql = $sql->where("response", $response);
        }

        $lists = $sql->order("id", "desc")->paginate($limit, false, ['query'=>request()->param() ]);

        foreach ($lists as &$list) {
            $list->user = $list->user;
        }
        return $lists;
    }
}
