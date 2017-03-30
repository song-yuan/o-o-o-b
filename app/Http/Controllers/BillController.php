<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\BillRepository;
use App\Repositories\BillLogRepository;
use App\Repositories\PartnerRepository;
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
        
        $bills = $billRep->getList($billSn);
        return view('bills/index', array(
            'bills' => $bills,
            'billSn' => $billSn
        ));
    }

    public function create() {
        $partnerRep = new PartnerRepository();
        $partners = $partnerRep->lists('partner_name', 'partner_id');
        return view('bills/create', array(
            'partners' => $partners
        ));
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
    
    public function logs($billSn) {
        $billLogRep = new BillLogRepository();        
        $billLogs = $billLogRep->findAllBy("bill_sn", $billSn, ["log_id", "desc"]);
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
            'partner_id',
            'sender_name',
            'sender_address',
            'receiver_name',
            'receiver_address',
        );
        Excel::load(public_path($filepath), function($reader) use ($fields) {
            $result = $reader->getSheet(0)->toArray();
            foreach($result as $index => $row) {
                if(!$index || !$row[0]) {
                    continue;
                }
                $partnerRep = new PartnerRepository();
                $partner = $partnerRep->findBy('partner_name', $row[1]);
                if(!$partner) {
                    continue;
                }
                $billRep = new BillRepository();
                if($billRep->findBy('bill_sn', $row[0])) {
                    continue;
                }
                
                $data = array_combine($fields, $row);
                $billRep->create($data);
            }
        }, 'UTF-8');
        return redirect('bill');
    }
    
    public function billtpl() {
        $title = array(
            '物流编号',
            '快递公司',
            '发货人',
            '发货地址',
            '收货人',
            '收货地址',
        );
        Excel::create('bill_tpl', function($excel) use($title) {
            $excel->sheet('Sheet1', function($sheet) use($title) {
                $sheet->row(1, $title);
            });
        })->export('xls');
    }

}
