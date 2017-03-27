<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => 'logout']);
        $this->articleRep = new ArticleRepository();
    }
    
    public function index() {
        $this->articleRep = new ArticleRepository();
        $articles = $this->articleRep->lists();
        
        return view('article.index', array(
            'articles' => $articles,
        ));
    }
    
    public function create() {
        $catRep = new CategoryRepository();
        $categories = $catRep->selector();
        
        return view('article.create', array(
            'categories' => $categories
        ));
    }
    
    public function store(Request $request) {
        $data = $request->input('article');
        
        $validator = $this->articleRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $this->articleRep->create($data);
        return redirect(url('article'));
    }
    
    public function edit($id) {
        $article = $this->articleRep->find($id);
        $catRep = new CategoryRepository();
        $categories = $catRep->selector();
        
        return view('article.update', array(
            'article' => $article,
            'categories' => $categories
        ));
    }
    
    public function update(Request $request, $id) {
        $data = $request->input('article');
        $validator = $this->articleRep->validator($data);
        if($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator);
        }
        $this->articleRep->update($data, $id);
        return redirect(url('article'));
    }

}
