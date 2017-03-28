<?php
namespace App\Http\Controllers;
use Excel;
class TestController extends Controller
{
    public function index() {
        // 9159548134
        $url = "http://www.cn.dhl.com/shipmentTracking?AWB=9159548134&countryCode=cn&languageCode=zh&_=1490670584799";
        $content = file_get_contents($url);
        echo "<pre>";var_dump(json_decode($content));exit;
//        return view('test.index', array(
//            'content' => $content
//        ));
    }

}
