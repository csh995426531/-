<?php
namespace app\index\service;

use app\index\model\ItemHistory;

/**
 * 商品服务层
 *
 * @author    cuisaihang<1114313879@qq.com>
 */
class Item
{
    public static $instance;

    public static function getInstance(){
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * 创建商品历史
     */
    public function createHistory($itemId, $event, $eventId, $result=1) {
        
        $model = new ItemHistory;
        $model->data([
            'item_id' => $itemId,
            'event' => $event,
            'event_id' => $eventId,
            'result' => $result,
            'create_time' => time()
        ]);
        if (!$model->save()) {
            throw new \Exception("保存错误");
        }
        return true;
    }
}