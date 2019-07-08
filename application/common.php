<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

function Message($message='', $type=true){
    if ($type == true) {

        $result = '
            <div class="alert alert-success">
				<a class="close" data-dismiss="alert" href="#">x</a>
				<h4 class="alert-heading">成功</h4>
				'. $message .'
			</div>
            ';

    } else {

        $result = '
            <div class="alert alert-error">
				<a class="close" data-dismiss="alert" href="#">x</a>
				<h4 class="alert-heading">失败</h4>
				'. $message .'
			</div>
            ';
    }
    return $result;
}


function SetResult($code=0, $data=[]) {
    return [
        'code' => $code,
        'data' => $data
    ];
}

function AddLog($action, $request, $response, $userId){

    $model = new \app\index\model\Log;
    $model->data([
        'user_id' => $userId,
        'action' => $action,
        'request' => $request,
        'response' => $response,
        'create_time' => time(),
    ]);
    $model->save();
}
