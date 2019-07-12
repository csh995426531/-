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

    //统计
    public function profit()
    {

        $startDate = $this->request->get("start_date");

        $endDate = $this->request->get("end_date");

        $incomeChannelId = $this->request->get("income_channel_id");
        
        $outgoChannelId = $this->request->get("outgo_channel_id");

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

            if (!empty($incomeChannelId) && $incomeChannelId > 0) {
                $sql = $sql->where("t.channel_id", $incomeChannelId);
            }

            if (!empty($$createUserId) && $createUserId > 0) {
                $sql = $sql->where("h.create_user_id", '=', $createUserId);
            }
            
            $sql2 = clone $sql;

            $incomePrice = $sql->sum('t.price'); 
            $incomeCount = $sql2->count();
            $aveIncomePrice =  $incomeCount == 0 ? 0 :  round($incomePrice / $incomeCount, 2) ;

            $sql = Db::name('ItemOutgoHistory')
                ->alias('oh')
                ->join('Item i', 'i.id=oh.item_id')
                ->where("oh.status", 'in', [
                    ItemOutgoHistory::STATUS_SUCCESS,
                    ItemOutgoHistory::STATUS_RETURN_WAIT
                ]);

            if (!empty($startDate)) {
                $sql = $sql->where("oh.date", '>=', $startDate);
            }

            if (!empty($endDate)) {
                $sql = $sql->where("oh.date", '<=', $endDate);
            }

            if (!empty($outgoChannelId) && $outgoChannelId > 0) {
                $sql = $sql->where("oh.channel_id", $outgoChannelId);
            }
            
            $sql3 = clone $sql;
        
            $priceTemp = $sql->field("sum(i.price) as income_price,sum(oh.price) as outgo_price")->find();
            $incomePrice2 = floatval($priceTemp['income_price']);
            $outgoPrice = floatval($priceTemp['outgo_price']);
            $profit = $outgoPrice > 0 ? $outgoPrice - $incomePrice2 - 100 : 0; 

            $outgoCount = $sql3->count();
            

            $aveOutgoPrice = $outgoCount == 0 ? 0 : round($outgoPrice / $outgoCount, 2);
            $aveProfit = $outgoCount == 0 ? 0 : round($profit / $outgoCount, 2);

        } else {
            $incomePrice = 0;
            $incomeCount = 0;
            $aveIncomePrice =  0;

            $outgoPrice = 0;
            $profit = 0;
            $outgoCount = 0;
            $aveOutgoPrice = 0;
            $aveProfit = 0;
        }

        $incomeChannelIds = Db::table('y5g_item')->distinct(true)->field("channel_id")->select();

        if (!empty($incomeChannelIds)) {
            $incomeChannels = ItemChannel::where("id", 'in', array_column($incomeChannelIds, 'channel_id'))->select();
        } else {
            $incomeChannels = [];
        }

        $createUserIds = Db::table('y5g_item_income_history')->distinct(true)->field("create_user_id")->select();

        if (!empty($createUserIds)) {
            $createUsers = User::where("id", 'in', array_column($createUserIds, 'create_user_id'))->select();
        } else {
            $createUsers = [];
        }

        $outgoChannelIds = Db::table('y5g_item_outgo_history')->distinct(true)->field("channel_id")->select();

        if (!empty($outgoChannelIds)) {
            $outgoChannels = ItemChannel::where("id", 'in', array_column($outgoChannelIds, 'channel_id'))->select();
        } else {
            $outgoChannels = [];
        }

        $breadcrumb = '统计';

        AddLog(\app\index\model\Log::ACTION_STATISTICS_PROFIT, json_encode($this->request->param())
            , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

        return $this->fetch('profit', [
            'breadcrumb' => $breadcrumb,
            'income_channels' => $incomeChannels,
            'create_users' => $createUsers,
            'outgo_channels' => $outgoChannels,
            'income_price' => $incomePrice,
            'income_count' => $incomeCount,
            'ave_income_price' => $aveIncomePrice,
            'outgo_price' => $outgoPrice,
            'profit' => $profit,
            'outgo_count' => $outgoCount,
            'ave_outgo_price' => $aveOutgoPrice,
            'ave_profit' => $aveProfit,
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
    }
}
