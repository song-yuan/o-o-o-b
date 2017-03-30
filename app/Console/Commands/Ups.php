<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\BillRepository;
use App\Repositories\BillLogRepository;
use App\Libraries\Curl;

class Ups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ups:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $billRep;
    public $billLogRep;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->billRep = new BillRepository();
        $this->billLogRep = new BillLogRepository();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bills = $this->billRep->findWhere(["status" => 0, "partner_id" => 2]);
        if(!$bills) {return false;}
        foreach($bills as $bill) {
            $logs = $this->getLogs($bill->bill_sn);
            $billLogs = $this->billLogRep->findAllBy('bill_sn', $bill->bill_sn, ["log_id", "asc"])->toArray();
            
            $count1 = count($logs);
            $count2 = count($billLogs);
            if($count1 > $count2) {
                for($i = $count2; $i < $count1; $i ++) {
                    $billLogRep = new BillLogRepository();
                    $billLogRep->create($logs[$i]);
                }
            }
        }
    }
    
    public function getLogs($billSn) {
        $url = "https://wwwapps.ups.com/WebTracking/track?loc=zh_CN";
        $curl = new Curl();
        $result = $curl->post($url, array(
            'loc' => 'zh_CN',
            'tbifl' => 1,
            'hiddenText' => '',
            'tracknum' => $billSn,
            'track.x' => '追踪',
            'trackSelectedOption' => ''
        ));
        $pattern = '/<table border="0" cellpadding="0" cellspacing="0" class="dataTable">(.+?)<\/table>/is';
        preg_match($pattern, $result, $match);
        $logs = array();
        
        if($match) {
            $pattern = '/<tr.*?>(.+?)<\/tr>/is';
            preg_match_all($pattern, $match[0], $results);
            $trs = array_unique($results[0]);
            unset($trs[0]);
            $trs =  array_reverse($trs);
            
            foreach($trs as $tr) {
                $tr = preg_replace ('/\s+/', ' ', $tr);
                $tr = strtr($tr, array('<tr class="odd">' => '', '<tr >' => '', '<tr>'=>'', '</tr>'=>''));
                $arr = explode('</td>', $tr);
                
                $location = strtr($arr[0], array('<td class="nowrap">' => '', '<td>' => ''));
                $date = strtr($arr[1], array('<td class="nowrap">' => '', '<td>' => ''));
                $time = strtr($arr[2], array('<td class="nowrap">' => '', '<td>' => ''));
                $description = strtr($arr[3], array('<td class="nowrap">' => '', '<td>' => ''));
                $logs[] = array(
                    'bill_sn' => $billSn,
                    'date' => trim($date, ' '),
                    'time' => trim($time, ' '),
                    'location' => trim($location, ' '),
                    'description' => trim($description, ' ')
                );
            }
        }
        return $logs;
    }
}
