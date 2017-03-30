<?php
namespace App\Http\Controllers;
use Excel;
use App\Libraries\Curl;
use App\Repositories\BillLogRepository;

class TestController extends Controller
{
    public function index() {
        $billLogRep = new BillLogRepository();
        
        //DHL 9159548134
        $billSn = '9159548134';
        $url = "http://www.cn.dhl.com/shipmentTracking?AWB=9159548134&countryCode=cn&languageCode=zh&_=1490670584799";
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
        $billLogs = $billLogRep->findAllBy('bill_sn', $billSn, ["log_id", "asc"])->toArray();
        $count1 = count($logs);
        $count2 = count($billLogs);
        if($count1 > $count2) {
            for($i = $count2; $i < $count1; $i ++) {
                $billLogRep = new BillLogRepository();
                $billLogRep->create($logs[$i]);
            }
        }
        echo "<pre>";var_dump($logs);exit;
        
        
        //UPS 1Z0036R90448216779
        $billSn = '1Z0036R90448216779';
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
        if($match) {
            $pattern = '/<tr.*?>(.+?)<\/tr>/is';
            preg_match_all($pattern, $match[0], $results);
            $trs = array_unique($results[0]);
            unset($trs[0]);
            $trs =  array_reverse($trs);
            $logs = array();
            
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
            $billLogs = $billLogRep->findAllBy('bill_sn', $billSn, ["log_id", "asc"])->toArray();
            
            $count1 = count($logs);
            $count2 = count($billLogs);
            if($count1 > $count2) {
                for($i = $count2; $i < $count1; $i ++) {
                    $billLogRep = new BillLogRepository();
                    $billLogRep->create($logs[$i]);
                }
            }
//            echo "<pre>";var_dump($logs);exit;
        }
        exit;
    }

}
