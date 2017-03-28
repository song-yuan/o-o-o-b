<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Route;
class CategoryController extends Controller
{
    public $catRep;
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
        $this->catRep = new CategoryRepository();
    }
    
    public function index() {
        $categories = $this->catRep->paginate([], ['category_id', 'desc']);
        
        return view('category.index', array(
            'categories' => $categories
        ));
    }
    
    public function create() {
        return view('category.create');
    }
    
    public function store(Request $request) {
        $data = $request->input('category');
        
        $validator = $this->catRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $this->catRep->create($data);
        return redirect(url('category'));
    }
    
    public function edit($id) {
        $category = $this->catRep->find($id);
        
        return view('category.update', array(
            'category' => $category
        ));
    }
    
    public function update(Request $request, $id) {
        $data = $request->input('category');
        $validator = $this->catRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $this->catRep->update($data, $id);
        return redirect(url('category'));
    }

}
