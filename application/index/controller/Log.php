Call to undefined method <?php
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\User;
use think\Db;
use think\Session;

class Log extends BaseController
{
    public function index()
    {

        $lists = \app\index\model\Log::where('id', '>', 0);

        $startDate = $this->request->get("start_date");

        $endDate = $this->request->get("end_date");

        $userId = $this->request->get('user_id');

        $action = $this->request->get("action");

        $response = $this->request->get("response");

        if (!empty($startDate)) {
            $lists = $lists->where("create_time", '>=',  strtotime($startDate));
        }

        if (!empty($endDate)) {
            $lists = $lists->where("create_time", '<=',  strtotime($endDate) + 86400);
        }

        if (!empty($userId) && $userId > 0) {
            $lists = $lists->where("user_id", $userId);
        }

        if (!empty($action)) {
            $lists = $lists->where("action", $action);
        }

        if (!empty($response)) {
            $lists = $lists->where("response", $response);
        }

        $lists = $lists->order("id", "desc")->paginate(10);

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

        AddLog(\app\index\model\Log::ACTION_LOG, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $this->fetch('index', [
            'breadcrumb' => $breadcrumb,
            'lists' => $lists,
            'users' => $users,
            'actions' => $actions,
            'responses' => $responses,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
    }

}
