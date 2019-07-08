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

            try {

                if (empty($account) || empty($pwd)) {

                    throw new \Exception("账号和密码不能为空");
                }

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
}
