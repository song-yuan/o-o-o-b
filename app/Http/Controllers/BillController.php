<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\BillRepository;
use App\Repositories\BillLogRepository;
use App\Libraries\UploadsManager;
use Excel;
class BillController extends Controller
{
    public $fileManager;
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
        $this->fileManager = UploadsManager::init()->setConfig('bills');
    }
    
    public function index(Request $request) {
        $billRep = new BillRepository();
        $billSn = $request->input('bill_sn', null);
        
        $bills = $billRep->lists($billSn);
        
        return view('bills/index', array(
            'bills' => $bills,
            'billSn' => $billSn
        ));
    }

    public function create() {
        return view('bills/create');
    }
    
    public function store(Request $request) {
        $data = $request->input('bill');
        $billRep = new BillRepository();
        
        $validator = $billRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $billRep->create($data);
        return redirect(url('bill'));
    }
    
    public function edit($id) {
        $billRep = new BillRepository();
        $bill = $billRep->find($id);
        
        return view('bills/update', array(
            'bill' => $bill
        ));
    }
    
    public function update(Request $request, $id) {
        $data = $request->input('bill');
        $billRep = new BillRepository();
        
        $validator = $billRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $billRep->update($data, $id);
        return redirect(url('bill'));
    }

    
    
    public function remark($id) {
        $billRep = new BillRepository();
        $bill = $billRep->find($id);
        return view('bills/remark', array(
            'bill' => $bill
        ));
    }
    
    public function logged(Request $request, $id) {
        $data = $request->input('bill_log');
        $billRep = new BillRepository();
        $bill = $billRep->find($id);
        $billLogRep = new BillLogRepository();
        
        $validator = $billLogRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $billLogRep->create($data);
        return redirect(url('bill'));
    }
    
    public function logs($billSn) {
        $billLogRep = new BillLogRepository();        
        $billLogs = $billLogRep->lists($billSn);
        return view('bills.logs', array(
            'billLogs' => $billLogs
        ));
    }
    
    public function import(Request $request) {
        if ($request->hasFile('bills')) {
            if($this->fileManager->check('bills')) {
                $filepath = $this->fileManager->saveFile('bills');
            } else {
                
            }
        }
        $fields = array(
            'bill_sn',
            'sender_name',
            'sender_address',
            'receiver_name',
            'receiver_address',
            'sended_at',
            'signed_at',
        );
        Excel::load(public_path($filepath), function($reader) use ($fields) {
            $result = $reader->getSheet(0)->toArray();
            foreach($result as $index => $row) {
                if(!$index || !$row[0]) {
                    continue;
                }
                if(!isset($row[6])) {
                    $row[6] = null;
                }
                $billRep = new BillRepository();
                $data = array_combine($fields, $row);
                $billRep->create($data);
            }
        }, 'UTF-8');
        return redirect('bill');
    }
    
    public function importlog() {
        if ($request->hasFile('bill_log')) {
            if($this->fileManager->check('bill_log')) {
                $filepath = $this->fileManager->saveFile('bill_log');
            } else {
                
            }
        }
        $fields = array(
            'bill_sn',
            'remark',
            'arrived_at'
        );
        Excel::load(public_path($filepath), function($reader) use ($fields) {
            $result = $reader->getSheet(0)->toArray();
            foreach($result as $index => $row) {
                if(!$index || !$row[0]) {
                    continue;
                }
                
                $billLogRep = new BillLogRepository();
                $data = array_combine($fields, $row);
                $billLogRep->create($data);
            }
        }, 'UTF-8');
        return redirect('bill');
    }
    
    public function billtpl() {
        $title = array(
            '物流编号',
            '发货人',
            '发货地址',
            '收货人',
            '收货地址',
            '发货日期',
            '签收日期',
        );
        Excel::create('bill_tpl', function($excel) use($title) {
            $excel->sheet('Sheet1', function($sheet) use($title) {
                $sheet->row(1, $title);
                $sheet->setColumnFormat(array(
                    'F' => 'yyyy-mm-dd hh:mm:ss',
                    'G' => 'yyyy-mm-dd hh:mm:ss',
                ));
            });
        })->export('xls');
    }

    public function logtpl() {
        $title = array(
            '物流编号',
            '备注',
            '日期'
        );
        Excel::create('bill_log_tpl', function($excel) use($title) {
            $excel->sheet('Sheet1', function($sheet) use($title) {
                $sheet->row(1, $title);
                $sheet->setColumnFormat(array(
                    'C' => 'yyyy-mm-dd H:i:s'
                ));
            });
        })->export('xls');
    }

}
