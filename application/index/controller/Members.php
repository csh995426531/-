<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/29
 * Time: 23:30
 */
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\AccessNode;
use app\index\model\User;
use app\index\model\UserAccess;
use think\Db;
use think\Session;

class Members extends BaseController
{
    //添加账号
    public function add(){

        if ($this->request->isPost()) {

            $name = $this->request->post('name');

            $pwd_1 = $this->request->post('pwd_1');

            $pwd_2 = $this->request->post('pwd_2');

            try {

                if(empty($name)){

                    throw new \Exception("账号名不能为空");
                }elseif (!preg_match('/^[a-zA-Z0-9]{6,16}$/',trim($name))) {
                    throw new \Exception("账号名不符合规则，需要为长度大于6位的字母或数字");
                }

                if(empty($pwd_1)){
                    throw new \Exception("账号密码不能为空");
                }elseif (!preg_match('/^[a-zA-Z0-9]{6,16}$/',trim($pwd_1))) {
                    throw new \Exception("账号密码不符合规则，需要为长度大于6位的字母或数字");
                }

                if(empty($pwd_2) || $pwd_2 != $pwd_1){
                    throw new \Exception("两次密码输入不一致");
                }

                $user = new User;
                $user->data([
                    'username' => $name,
                    'pwd' => md5($pwd_1 . "y5g"),
                ]);
                $user->add();

                $result = SetResult(200, '操作成功');
            } catch (\Exception $e) {
                $result = SetResult(500, $e->getMessage());
            }

            return $result;
        }

        return $this->fetch("add");
    }

    //密码修改
    public function updatePwd(){

        if ($this->request->isPost()) {

            try{

                $userId = $this->request->post('user_id');

                $pwd_1 = $this->request->post('pwd_1');

                $pwd_2 = $this->request->post('pwd_2');

                $user = User::where("id", $userId)->find();

                if (empty($user)) {
                    throw new \Exception("账号不存在");
                }

                if(empty($pwd_1)){
                    throw new \Exception("账号密码不能为空");
                }elseif (!preg_match('/^[a-zA-Z0-9]{6,16}$/',trim($pwd_1))) {
                    throw new \Exception("账号密码不符合规则，需要为长度大于6位的字母或数字");
                }

                if(empty($pwd_2) || $pwd_2 != $pwd_1){
                    throw new \Exception("两次密码输入不一致");
                }

                $user->data([
                    'pwd' => md5($pwd_1 . "y5g"),
                    'update_time' => time(),
                ]);

                $num = $user->save();

                if ($num !=1) {
                    throw new \Exception("更新失败");
                }

                $result = SetResult(200, '操作成功');
            } catch (\Exception $e) {

                $result = SetResult(500, $e->getMessage());
            }

            return $result;
        }

        $users = User::where("status", User::STATUS_ACTIVE)->select();

        return $this->fetch('update_pwd', [
            'users' => $users,
        ]);
    }

    //权限修改
    public function updateAccess(){

        if ($this->request->isPost()) {

            $userId = $this->request->post('user_id',0);

            $nodes = $this->request->post('node_ids/a', []);

            Db::startTrans();
            try {

                $user = User::where("id", $userId)->find();

                if (empty($user)) {
                    throw new \Exception("账号不存在");
                }

                $userNodes = UserAccess::where('user_id', $user->id)
                    ->where("status", UserAccess::STATUS_ACTIVE)
                    ->select();

                if (!empty($userNodes)) {
                    $temp = collection($userNodes)->toArray();

                    $userNodes = array_column($temp, 'node_id');
                }

                $addNodes = array_diff($nodes, $userNodes);
                $delNodes = array_diff($userNodes, $nodes);

                //增加用户权限
                if (!empty($addNodes)) {

                    //存在用户失效的权限记录
                    $userInvalidNodes = UserAccess::where('user_id', $user->id)
                        ->where("status", UserAccess::STATUS_INVALID)
                        ->select();
                    if (!empty($userInvalidNodes)) {
                        $temp = collection($userInvalidNodes)->toArray();

                        $userInvalidNodes = array_column($temp, 'node_id');
                    }

                    $insertData = [];
                    $updateData = [];
                    foreach ($addNodes as $nodeTemp) {

                        if (in_array($nodeTemp, $userInvalidNodes)) {
                            $updateData[] = $nodeTemp;
                        } else {

                            $insertData[] = [
                                'user_id' => $userId,
                                'node_id' => $nodeTemp,
                                'status' => UserAccess::STATUS_ACTIVE,
                                'create_time' => time(),
                                'update_time' => time(),
                            ];
                        }
                    }

                    $insertNum = 0;
                    $updateNum = 0;
                    if (!empty($insertData)) {
                        $insertNum = UserAccess::insertAll($insertData);
                    }

                    if (!empty($updateData)) {
                        $updateNum = UserAccess::where("user_id", $user->id)
                            ->where("status", UserAccess::STATUS_INVALID)
                            ->where("node_id", "in", $updateData)
                            ->update(["status" => UserAccess::STATUS_ACTIVE, "update_time" => time()]);
                    }

                    if ($insertNum+$updateNum != count($addNodes)) {
                        throw  new \Exception("新加权限错误");
                    }
                }

                //删除用户权限
                if (!empty($delNodes)) {

                    $num = UserAccess::where("user_id", $user->id)
                        ->where("status", UserAccess::STATUS_ACTIVE)
                        ->where("node_id", "in", $delNodes)
                        ->update(["status" => UserAccess::STATUS_INVALID, "update_time" => time()]);

                    if ($num != count($delNodes)) {
                        throw  new \Exception("更新权限错误");
                    }
                }

                Db::commit();
                $result = SetResult(200, '操作成功');
            } catch (\Exception $e) {
                Db::rollback();
                $result = SetResult(500, $e->getMessage());
            }

            return $result;
        } else {
            $message = '';
            $userId = '';
        }

        $users = User::where("status", User::STATUS_ACTIVE)->select();

        foreach ($users as $temp) {

            $userNodes = UserAccess::where('user_id', $temp->id)
                ->where("status", UserAccess::STATUS_ACTIVE)
                ->select();

            if (!empty($userNodes)) {
                $userNodesTemp = collection($userNodes)->toArray();

                $userNodes = array_column($userNodesTemp, 'node_id');
            }

            $temp->nodes = $userNodes;
            $temp['nodes'] = $userNodes;
        }

        $nodesData = AccessNode::where("parent_id", 0)->select();

        $nodes = [];

        foreach ($nodesData as $temp) {

            $nodes[$temp->id]['name'] = $temp->name;

            $children = AccessNode::where("parent_id", $temp->id)->select();
            $nodes[$temp->id]['children'] = $children;
        }

        return $this->fetch('update_access', [
            'message' => $message,
            'users' => $users,
            'user_id' => $userId,
            'nodes' => $nodes,
        ]);
    }
}