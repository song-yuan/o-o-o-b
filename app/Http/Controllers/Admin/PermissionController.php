<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PermissionRepository;

class PermissionController extends Controller {
    public function __construct() {
        $this->rep = new PermissionRepository();
    }
    
    public function index() {
        $permissions = $this->rep->paginate();
        return view('admin.permission.index', array(
            'permissions' => $permissions
        ));
    }
    
    public function create() {
        return view('admin.permission.create');
    }
    
    public function store(Request $request) {
        $data = $request->input('permission');
        $validator = $this->rep->validator($data);
        if($validator->fails()) {
            return redirect(url('permission/create'))->withInput($data)->withErrors($validator);
        }
        $this->rep->create($data);
        return response()->json(array(
            'status' => 'ok'
        ));
    }
    
    public function edit($id) {
        $permission = $this->rep->find($id);
        return view('admin.permission.update', array(
            'permission' => $permission
        ));
    }
    
    public function update(Request $request, $id) {
        $data = $request->input('permission');
        $validator = $this->rep->validator($data);
        if($validator->fails()) {
            return redirect(url('permission/update', array($id)))->withInput($data)->withErrors($validator);
        }
        $this->rep->update($data, $id);
        return response()->json(array(
            'status' => 'ok'
        ));
    }
}