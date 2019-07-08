<?php
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\ItemChannel;
use app\index\model\ItemIncomeHistory;
use app\index\model\ItemOutgoHistory;
use app\index\model\User;
use think\Db;
use think\Session;

class Statistics extends BaseController
{
    //进货统计
    public function income()
    {

        $startDate = $this->request->get("start_date");

        $endDate = $this->request->get("end_date");

        $channelId = $this->request->get("channel_id");

        $createUserId = $this->request->get("create_user_id");

        $mark = $this->request->get('mark');

        if ($mark == 1) {

            $sql = \app\index\model\Item::alias("t")
                ->join("item_income_history h", 'h.item_id=t.id')
                ->where("h.type", ItemIncomeHistory::TYPE_INCOME)
                ->where("h.status", ItemIncomeHistory::STATUS_SUCCESS);

            if (!empty($startDate)) {
                $sql = $sql->where("t.date", '>=', $startDate);
            }

            if (!empty($endDate)) {
                $sql = $sql->where("t.date", '<=', $endDate);
            }

            if (!empty($channelId) && $channelId > 0) {
                $sql = $sql->where("t.channel_id", $channelId);
            }

            if (!empty($createUserId)) {

                $histories = Db::table("y5g_item_income_history")->where("create_user_id", $createUserId)->select();
                if (!empty($histories)) {
                    $sql = $sql->where("t.id", 'in', array_column($histories, 'item_id'));
                }
            }

            $price = $sql->sum('t.price');

            $sql = \app\index\model\Item::alias("t")
                ->join("item_income_history h", 'h.item_id=t.id')
                ->where("h.type", ItemIncomeHistory::TYPE_INCOME)
                ->where("h.status", ItemIncomeHistory::STATUS_SUCCESS);

            if (!empty($startDate)) {
                $sql = $sql->where("t.date", '>=', $startDate);
            }

            if (!empty($endDate)) {
                $sql = $sql->where("t.date", '<=', $endDate);
            }

            if (!empty($channelId) && $channelId > 0) {
                $sql = $sql->where("t.channel_id", $channelId);
            }

            if (!empty($createUserId)) {

                $histories = Db::table("y5g_item_income_history")->where("create_user_id", $createUserId)->select();
                if (!empty($histories)) {
                    $sql = $sql->where("t.id", 'in', array_column($histories, 'item_id'));
                }
            }

            $count = $sql->count();

        } else {
            $count = 0;
            $price = 0;
        }

        $channelIds = Db::table('y5g_item')->distinct(true)->field("channel_id")->select();

        if (!empty($channelIds)) {
            $channels = ItemChannel::where("id", 'in', array_column($channelIds, 'channel_id'))->select();
        } else {
            $channels = [];
        }

        $createUserIds = Db::table('y5g_item_income_history')->distinct(true)->field("create_user_id")->select();

        if (!empty($createUserIds)) {
            $createUsers = User::where("id", 'in', array_column($createUserIds, 'create_user_id'))->select();
        } else {
            $createUsers = [];
        }

        $breadcrumb = '进货统计';

        AddLog(\app\index\model\Log::ACTION_STATISTICS_INCOME, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $this->fetch('income', [
            'breadcrumb' => $breadcrumb,
            'channels' => $channels,
            'createUsers' => $createUsers,
            'price' => $price,
            'count' => $count,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
    }

    //利润统计
    public function profit()
    {

        $startDate = $this->request->get("start_date");

        $endDate = $this->request->get("end_date");

        $channelId = $this->request->get("channel_id");

        $mark = $this->request->get('mark');

        if ($mark == 1) {

            $sql = ItemOutgoHistory::where("status", 'in', [
                ItemOutgoHistory::STATUS_SUCCESS,
                ItemOutgoHistory::STATUS_RETURN_WAIT
            ]);

            if (!empty($startDate)) {
                $sql = $sql->where("date", '>=', $startDate);
            }

            if (!empty($endDate)) {
                $sql = $sql->where("date", '<=', $endDate);
            }

            if (!empty($channelId) && $channelId > 0) {
                $sql = $sql->where("channel_id", $channelId);
            }

            $price = $sql->sum('price');

            $sql = ItemOutgoHistory::where("status", 'in', [
                ItemOutgoHistory::STATUS_SUCCESS,
                 ItemOutgoHistory::STATUS_RETURN_WAIT
            ]);

            if (!empty($startDate)) {
                $sql = $sql->where("date", '>=', $startDate);
            }

            if (!empty($endDate)) {
                $sql = $sql->where("date", '<=', $endDate);
            }

            if (!empty($channelId) && $channelId > 0) {
                $sql = $sql->where("channel_id", $channelId);
            }

            $count = $sql->count();

            if ($count > 0) {

                $sql = ItemOutgoHistory::where("status", 'in', [
                    ItemOutgoHistory::STATUS_SUCCESS,
                     ItemOutgoHistory::STATUS_RETURN_WAIT
                ]);

                if (!empty($startDate)) {
                    $sql = $sql->where("date", '>=', $startDate);
                }

                if (!empty($endDate)) {
                    $sql = $sql->where("date", '<=', $endDate);
                }

                if (!empty($channelId) && $channelId > 0) {
                    $sql = $sql->where("channel_id", $channelId);
                }

                $historyIds = collection($sql->select())->toArray();
                $incomePrice = \app\index\model\Item::where('id', 'in', array_column($historyIds, 'item_id'))
                ->sum("price");
                $profit = $price - $incomePrice;
            } else {

                $profit = 0;
            }

        } else {
            $count = 0;
            $price = 0;
            $profit = 0;
        }

        $channelIds = Db::table('y5g_item_outgo_history')->distinct(true)->field("channel_id")->select();

        if (!empty($channelIds)) {
            $channels = ItemChannel::where("id", 'in', array_column($channelIds, 'channel_id'))->select();
        } else {
            $channels = [];
        }

        $breadcrumb = '利润统计';

        AddLog(\app\index\model\Log::ACTION_STATISTICS_PROFIT, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $this->fetch('profit', [
            'breadcrumb' => $breadcrumb,
            'channels' => $channels,
            'price' => $price,
            'count' => $count,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'profit' => $profit,
        ]);
    }
}
