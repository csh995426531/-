<?php
/**
 * Created by PhpStorm.
 * User: csh
 * Date: 2019/5/30
 * Time: 1:23
 */
namespace app\index\model;

use think\Model;

class User extends Model
{
    public $nodes;
    const STATUS_ACTIVE = 1; //状态-有效
    const STATUS_INVALID = 2; //状态-无效

    public function add(){

        $user = User::where("username", $this->username)->find();


        if (!empty($user)) {

            throw new \Exception("该账号已存在");
        } else {

            $this->status = self::STATUS_ACTIVE;
            $this->create_time = time();
            $this->update_time = time();
            return $this->save();
        }
    }
}