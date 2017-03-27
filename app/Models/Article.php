<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Article extends Model {
    
    protected $table = 'articles';
    protected $primaryKey = 'article_id';
    protected $fillable = array(
        'category_id', 
        'title',
        'sub_head',
        'content'
    );
    
    public function category() {
        return $this->hasOne('App\Models\Category','category_id','category_id');
    }
}