<?php

namespace App\Http\Controllers;
use Excel;
class TestController extends Controller
{
    public function index()
    {
        Excel::load('uploads/20170316_GC0316_0.xlsx', function($reader){
            $result = $reader->getSheet(0)->toArray();  
            echo "<pre>";
            foreach($result as $row) {
                var_dump($row);
            }
            
        });
    }

}
