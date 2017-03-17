<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\BillRepository;
use App\Repositories\BillLogRepository;

class BillsController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
    }
    
    public function index(Request $request) {
        $billRep = new BillRepository();
        $billSn = $request->input('bill_sn', null);
        
        $bills = $billRep->lists($billSn);
        
        return view('bills/index', array(
            'bills' => $bills
        ));
    }

    public function logs(Request $request) {
        $billLogRep = new BillLogRepository();
        $billSn = $request->input('bill_sn', null);
        
        $billLogs = $billLogRep->lists($billSn);
        return view('bill.logs', array(
            'billLogs' => $billLogs
        ));
    }
    
    public function import(Request $request) {
        if ($request->hasFile('file')) {
            $result = $this->manager->saveFile('file');
        }
        $fields = array(
            'product_code',
            'barcode',
            'product_name',
            'type_id',
            'original_price',
            'expire',
            'product_discount',
            'stock',
            'begin_at',
            'end_at',
            'user_buy_number',
            'is_show',
        );
        if($result['status']) {
            Excel::load(public_path($result['filepath']), function($reader) use ($fields) {
                $reader = $reader->getSheet(0);  
                $res = $reader->toArray();  
                foreach($res as $index => $row) {
                    if(!$index || !$row[0]) {
                        continue;
                    }
                    $proRep = new ProRepository();
                    $data = array_combine($fields, $row);
                    $proRep->store($data);
                }
            }, 'UTF-8');
            return redirect('admin-product');
        } else {
            return redirect()->back();
        }
    }
    
    public function importLog() {
        
    }
}
