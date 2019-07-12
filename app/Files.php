<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'uploaded_files';
    protected $fillable = ['user_id', 'file_name','file_type','file_type_name','file_size','file_url_name'];
    public $timestamps = true;
    
    public function getFileTypes()
    {
       
    }
}
