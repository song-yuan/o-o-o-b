<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\BillRepository;
use App\Repositories\BillLogRepository;

class Dhl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dhl:sync';

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
        $bills = $this->billRep->findWhere(["status" => 0, "partner_id" => 1], ["bill_id", "asc"]);
        if(!$bills) {return false;}
        foreach($bills as $bill) {
            $logs = $this->getLogs($bill->bill_sn);
            $billLogs = $this->billLogRep->findAllBy('bill_sn', $bill->bill_sn, ["log_id", "asc"])->toArray();
            $count1 = count($logs);
            $count2 = count($billLogs);
            if($count1 <= $count2) {
                continue;
            }
            for($i = $count2; $i < $count1; $i ++) {
                $billLogRep = new BillLogRepository();
                $billLogRep->create($logs[$i]);
            }
        }
    }
    
    public function getLogs($billSn) {
        $url = "http://www.cn.dhl.com/shipmentTracking?AWB=".$billSn."&countryCode=cn&languageCode=zh&_=1490670584799";
        $curl = new Curl();
        $content = $curl->get($url);
        $body = json_decode($content->body);
        $checkpoints = $body->results[0]->checkpoints;
        
        $logs = array();
        foreach($checkpoints as $log) {
            $logs[] = array(
                'bill_sn' => $billSn,
                'date' => $log->date,
                'time' => $log->time,
                'location' => $log->location,
                'description' => $log->description,
            );
        }
        return $logs;
    }
}
