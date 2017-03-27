<?php
namespace App\Libraries;
use Carbon\Carbon;
use Dflydev\ApacheMimeTypes\PhpRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Request;
use Image;

class UploadsManager {
    protected $disk;
    protected $mimeDetect;
    public $hasThrumb;
    public $thrumbs;
    public $path;
    public $allowMimeType;
    public $allowSize;
    
    public $errorMessage;

    static $handler = null;

    private function __construct()
    {
        $this->mimeDetect = new PhpRepository();
        $this->setConfig();
        return $this;
    }
    
    public static function init() {
        if(self::$handler == null) {
            self::$handler = new UploadsManager();
        }
        return self::$handler;
    }
    
    public function setConfig($type = 'common') {
        $imagedir = config('imagedir');
        if(!isset($imagedir[$type])) {
            abort(404);
        }
        $this->hasThrumb = $imagedir[$type]['has_thrumb'];
        $this->thrumbs = $imagedir[$type]['thrumbs'];
        $this->disk = Storage::disk($imagedir[$type]['uploads']['storage']);
        $this->path = $imagedir[$type]['uploads']['webpath'];
        $this->allowMimeType = $imagedir[$type]['allow'];
        $this->allowSize = $imagedir[$type]['size'];
        
        return $this;
    }
    /**
     * Save a file, if has thrumb, copy and resize it to the thrumb directory
     */
    public function saveFile($field = 'file', $path = '')
    {
        $file = $_FILES[$field];
        $content = File::get($file['tmp_name']);
        $fileName = $this->genFileName(File::extension($file['name']));
        
        if($path) {
            $path = str_finish($path, '/').$fileName;
        } else {
            if(!is_dir($this->path)) {
                @mkdir($this->path,'0777',true);
            }
            $path = str_finish($this->path, '/').$fileName;
        }
        $this->disk->put($path, $content);
        
        if($this->hasThrumb) {
            $image = Image::make($this->fileWebpath($path));
            foreach($this->thrumbs as $thrumb) {
                $dir = str_finish(ltrim($this->path, '/'), '/').ltrim($thrumb['dir'], '/');
                if(!is_dir($dir)) {
                    @mkdir($dir, '0777', true);
                }
                $thrumbPath = str_finish($dir, '/').$fileName;
                list($width,$height) = explode('x',$thrumb['size']);
                $image->resize($width,$height)->save($thrumbPath,100);
            }
        }
        return $path;
    }
    
    public function genFileName($extension) {
        list($microTime, $time) = explode(' ',microtime());
        return date('YmdHis').'_'.($microTime*100000000).'_'.rand(1000,9999).'.'.$extension;
    }
    
    public function check($field) {
        $file = Request::file($field);
        $mimeType = $file->getMimeType();
        if(!$mimeType || !in_array($mimeType, $this->allowMimeType)) {
            $this->errorMessage = trans('file.mime_type_error');
            return false;
        }
        
        $fileSize = round($file->getSize() / 1024);
        if($fileSize > $this->allowSize) {
            $this->errorMessage = trans('file.too_large');
            return false;
        }
        return true;
    }

}