<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RoleRepository;

class RoleController extends Controller {
    
    public function __construct() {
        $this->rep = new RoleRepository();
    }
    
    public function index() {
        $roles = $this->rep->paginate();
        return view('admin.role.index', array(
            'roles' => $roles
        ));
    }
    
    public function create() {
        return view('admin.role.create');
    }
    
    public function store(Request $request) {
        $data = $request->input('role');
        $validator = $this->rep->validator($data);
        if($validator->fails()) {
            return redirect(url('role/create'))->withInput($data)->withErrors($validator);
        }
        $this->rep->create($data);
        return response()->json(array(
            'status' => 'ok'
        ));
    }
    
    public function edit($id) {
        $role = $this->rep->find($id);
        return view('admin.role.update', array(
            'role' => $role
        ));
    }
    
    public function update(Request $request, $id) {
        $data = $request->input('role');
        $validator = $this->rep->validator($data);
        if($validator->fails()) {
            return redirect(url('role/update', array($id)))->withInput($data)->withErrors($validator);
        }
        $this->rep->update($data, $id);
        return response()->json(array(
            'status' => 'ok'
        ));
    }
}