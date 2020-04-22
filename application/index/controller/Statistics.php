<?php
namespace app\index\controller;

use app\base\controller\BaseController;
use app\index\model\ItemChannel;
use app\index\model\ItemIncomeHistory;
use app\index\model\ItemOutgoHistory;
use app\index\model\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use think\Db;
use think\Session;
use app\index\model\ItemName;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Statistics extends BaseController
{
    public function index()
    {
        $breadcrumb = '首页';

        $start_time = strtotime('-30 day', strtotime(date("Y-m-d"),time()));
        $result = [];
        for ($time = $start_time; $time < time(); $time+=86400) {
            $result[date('Y-m-d', $time)] = [
                'date' => date('Y-m-d', $time),
                'income_amount' => 0,
                'income_num' => 0,
                'outgo_amount' => 0,
                'outgo_num' => 0,
                'return_amount' => 0,
                'return_num' => 0,
            ];
        }

        $income_date = \app\index\model\ItemIncomeHistory::alias('t')
            ->join('item i', 'i.id= t.item_id')
            ->where([
                't.status' => ['=', ItemIncomeHistory::STATUS_SUCCESS],
                't.type' => ['=', ItemIncomeHistory::TYPE_INCOME],
                't.create_time' => ['>=', $start_time]
            ])
            ->group('date')
            ->field('FROM_UNIXTIME(t.create_time, "%Y-%m-%d" ) as date, sum(i.price) as all_price, count(*) as all_num')
            ->order('date asc')
            ->select();

        foreach ($income_date as $temp) {
            $result[$temp['date']]['income_amount'] = number_format($temp['all_price'], 2, '.', '');
            $result[$temp['date']]['income_num'] = $temp['all_num'];
        }

        $outgo_date = \app\index\model\ItemOutgoHistory::where([
                'status' => ['in', [
                    ItemOutgoHistory::STATUS_SUCCESS,
                    ItemOutgoHistory::STATUS_RETURN_WAIT,
                    ItemOutgoHistory::STATUS_RETURN
                ]],
                'create_time' => ['>=', $start_time]
            ])
            ->field('sum(price) as all_price, count(*) as all_num, FROM_UNIXTIME(create_time, "%Y-%m-%d" ) as date')
            ->group('date')
            ->order('date asc')
            ->select();

        foreach ($outgo_date as $temp) {
            $result[$temp['date']]['outgo_amount'] = number_format($temp['all_price'], 2, '.', '');
            $result[$temp['date']]['outgo_num'] = $temp['all_num'];
        }

        $return_date = \app\index\model\ItemIncomeHistory::alias('t')
            ->join('item i', 'i.id= t.item_id')
            ->where([
                't.status' => ['=', ItemIncomeHistory::STATUS_SUCCESS],
                't.type' => ['=', ItemIncomeHistory::TYPE_RETURN_INCOME],
                't.create_time' => ['>=', $start_time]
            ])
            ->field('sum(i.price) as all_price, count(*) as all_num, FROM_UNIXTIME(t.create_time, "%Y-%m-%d" ) as date')
            ->group('date')
            ->order('date asc')
            ->select();

        foreach ($return_date as $temp) {
            $result[$temp['date']]['return_amount'] = number_format($temp['all_price'], 2, '.', '');
            $result[$temp['date']]['return_num'] = $temp['all_num'];
        }

        return $this->fetch('index', [
            'breadcrumb' => $breadcrumb,
            'date' => array_column($result, 'date'),
            'income_amount' => array_column($result, 'income_amount'),
            'income_num' => array_column($result, 'income_num'),
            'outgo_amount' => array_column($result, 'outgo_amount'),
            'outgo_num' => array_column($result, 'outgo_num'),
            'return_amount' => array_column($result, 'return_amount'),
            'return_num' => array_column($result, 'return_num')
        ]);
    }

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

        // AddLog(\app\index\model\Log::ACTION_STATISTICS_INCOME, json_encode($this->request->param())
        //     , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

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

        $nameId = $this->request->get('name_id');

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

            if (!empty($nameId) && $nameId > 0) {
                $sql = $sql->where("t.name_id", '=', $nameId);
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

            if (!empty($nameId) && $nameId > 0) {
                $sql = $sql->where("i.name_id", '=', $nameId);
            }
            
            $sql3 = clone $sql;
        
            $priceTemp = $sql->field("sum(i.price) as income_price,sum(oh.price) as outgo_price, sum(oh.cost) as cost")->find();
            $incomePrice2 = floatval($priceTemp['income_price']);
            $outgoPrice = floatval($priceTemp['outgo_price']);
            $cost  = floatval($priceTemp['cost']);
            $profit = $outgoPrice > 0 ? $outgoPrice - $incomePrice2 - $cost : 0; 

            $outgoCount = $sql3->count();
            

            $aveOutgoPrice = $outgoCount == 0 ? 0 : round($outgoPrice / $outgoCount, 2);
            $aveProfit = $outgoCount == 0 ? 0 : round($profit / $outgoCount, 2);

            if ($this->request->get("sub") == 'excel') {
                set_time_limit(0);
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setTitle('库存统计导出');

                $sheet->setCellValue('A1', '开始时间：')
                    ->setCellValue('A2', '结束日期：')
                    ->setCellValue('A3', '产品名称：')
                    ->setCellValue('A4', '进货渠道：')
                    ->setCellValue('A5', '进货人：')
                    ->setCellValue('A6', '出货途径：')

                    ->setCellValue('B1', !empty($startDate) ? $startDate : '')
                    ->setCellValue('B2', !empty($endDate) ? $endDate : '')
                    ->setCellValue('B3', !empty($nameId) ? ItemName::where('id', $nameId)->value('data') : '')
                    ->setCellValue('B4', !empty($incomeChannelId) ? ItemChannel::where('id', $incomeChannelId)->value('data') : '')
                    ->setCellValue('B5', !empty($createUserId) ? User::where('id', $createUserId)->value('username') : '')
                    ->setCellValue('B6', !empty($outgoChannelId) ? ItemChannel::where('id', $outgoChannelId)->value('data') : '')

                    ->setCellValue('D1', '进货总数量：')
                    ->setCellValue('D2', '进货总价格：')
                    ->setCellValue('D3', '平均进货价格：')
                    ->setCellValue('D4', '销售总数量：')
                    ->setCellValue('D5', '平均销售价格：')
                    ->setCellValue('D6', '总利润：')
                    ->setCellValue('D7', '平均利润：')

                    ->setCellValue('E1', $incomeCount)
                    ->setCellValue('E2', $incomePrice)
                    ->setCellValue('E3', $aveIncomePrice)
                    ->setCellValue('E4', $outgoCount)
                    ->setCellValue('E5', $aveOutgoPrice)
                    ->setCellValue('E6', $profit)
                    ->setCellValue('E7', $aveProfit);

                ob_end_clean();
//                if ($format == 'xls') {
//                    //输出Excel03版本
                    header('Content-Type:application/vnd.ms-excel');
                    $class = "\PhpOffice\PhpSpreadsheet\Writer\Xls";
//                } elseif ($format == 'xlsx') {
//                    //输出07Excel版本
//                    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//                    $class = "\PhpOffice\PhpSpreadsheet\Writer\Xlsx";
//                }
                //输出名称
                header('Content-Disposition:attachment;filename="'.mb_convert_encoding('库存统计导出',"GB2312", "utf-8").'.xls"');
                //禁止缓存
                header('Cache-Control: max-age=0');
                $writer = new $class($spreadsheet);
                $writer->save('php://output');

                $spreadsheet->disconnectWorksheets();
                unset($spreadsheet);
                exit;
            }
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

        $names = Db::table('y5g_item_name')->where('status', ItemName::STATUS_ACTIVE)->select();

        $breadcrumb = '统计';

        // AddLog(\app\index\model\Log::ACTION_STATISTICS_PROFIT, json_encode($this->request->param())
        //     , \app\index\model\Log::RESPONSE_SUCCESS, Session::get('user_id'));

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
            'end_date' => $endDate,
            'names' => $names
        ]);
    }
}
