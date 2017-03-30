<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\PartnerRepository;

class PartnerController extends Controller
{
    public $rep;
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
        $this->rep = new PartnerRepository();
    }
    
    public function index() {
        $partners = $this->rep->paginate([], ["partner_id", "desc"]);
        
        return view('partner.index', array(
            'partners' => $partners
        ));
    }
    
    public function create() {
        return view('partner.create');
    }
    
    public function store(Request $request) {
        $data = $request->input('partner');
        
        $validator = $this->rep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $this->rep->create($data);
        return redirect(url('partner'));
    }
    
    public function edit($id) {
        $partner = $this->rep->find($id);
        
        return view('partner.update', array(
            'partner' => $partner
        ));
    }
    
    public function update(Request $request, $id) {
        $data = $request->input('partner');
        $validator = $this->rep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $this->rep->update($data, $id);
        return redirect(url('partner'));
    }

}
