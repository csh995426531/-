<?php
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\User;
use think\Session;

class Index extends BaseController
{
    public function index()
    {
        return $this->fetch();
    }

    public function login()
    {
        if ($this->request->isPost()) {

            $account = $this->request->post("account");
            $pwd = $this->request->post("pwd");
            $captcha = $_REQUEST['captcha'];

            try {

                if (empty($account) || empty($pwd)) {

                    throw new \Exception("账号和密码不能为空");
                }

                if(!captcha_check($captcha)){
                    throw new \Exception('验证码输入错误');
                };

                $user = User::where("username", $account)
                    ->where("status", User::STATUS_ACTIVE)
                    ->find();

                if (empty($user)) {

                    throw new \Exception("账号不存在");
                }

                if (md5($pwd . "y5g") != $user->pwd) {

                    throw new \Exception("密码错误");
                }

                Session::set("user_id", $user->id);
                Session::set("user_name", $user->username);
                AddLog(\app\index\model\Log::ACTION_LOGIN, json_encode($_POST)
                    , \app\index\model\Log::RESPONSE_SUCCESS, $user->id);
                header('Location: '. Url("index"));exit();

            } catch (\Exception $e) {

                echo $e->getMessage();exit();
            }

        } else{

            $this->view->engine->layout(false);
            return $this->fetch("login");
        }
    }

    public function logout()
    {

        $userId = Session::get("user_id");

        if ($userId) {
            Session::delete("user_id");
            Session::delete("user_name");

            AddLog(\app\index\model\Log::ACTION_LOGOUT, json_encode(["id" => $userId])
                , \app\index\model\Log::RESPONSE_SUCCESS, $userId);
        }

        $this->redirect("index");
    }

    public function executSql()
    {
        header("Content-type:text/html;charset=utf-8");
        //配置信息
        $cfg_dbhost = '127.0.0.1';
        $cfg_dbname = 'maiguo';
        $cfg_dbuser = 'root';
        $cfg_dbpwd = '1c41b29c3f1bdf78';
        // 创建连接
        $conn = new \mysqli($cfg_dbhost, $cfg_dbuser, $cfg_dbpwd, $cfg_dbname);
        // 检测连接
        if ($conn->connect_error) {
            die("连接失败: " . $conn->connect_error);
        } 
        echo '连接成功';

        // // 使用 sql 创建数据表
        $sql = "ALTER TABLE `maiguo`.`y5g_item_outgo_history` ADD COLUMN `update_user_id` INT(10) UNSIGNED NOT NULL COMMENT '审核人' AFTER `cost`;";

        if ($conn->query($sql)) {
            echo "数据sql 更新成功";
        } else {
            echo "数据sql " .$conn->error;
        }
        die;
    }
}
