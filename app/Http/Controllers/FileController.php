<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Files;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Validator;
class FileController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
        //parent::__construct();  
    }
    public function getFiles()    { 
        $key = 'all';
        $files = Files::
            select('uploaded_files.*')->get();
            //->where(array('file_type_name'=> $file_type_name))->get();
            return view('files.get_files_by_types',compact('files','key'));
    }
    
    public function get_files_by_types($file_type_name)    
    {   
        $key = $file_type_name;
        //if you will switch multilang function it will helps you
        //$SysLang = \App::getLocale();
        $exists = Files::
        where([
            ['file_type_name', '=', $file_type_name],
            //['status_status', '=', 1],
        ])
        ->first();
        if ($exists) {
            $files = Files::
            select('uploaded_files.*')
            ->where(array('file_type_name'=> $file_type_name))->get();
            return view('files.get_files_by_types',compact('files','key'));
        }
        else {
            $files = Files::take(0);
            \Session::flash('warning', "This folder maybe empty");
            return view('files.get_files_by_types',compact('files','key'));
        }
    }

    //opload_store

    public function opload_store()    { 
        return view('files.get_files'); //,compact('')
    }

    public function addnew(Request $request)
    { 
    	$data =  \Input::except(array('_token')) ;
    	$rule=array(
    		'file_name' => 'required',            
    		'file_url_name' => 'required'
    	);
    	$validator = \Validator::make($data,$rule);
    	if ($validator->fails())
    	{
    		return redirect()->back()->withErrors($validator->messages());
    	} 
        $inputs = $request->all();
        //dd($request->all());
        //dd($request->file('file_name')->extension());
        //Varibale for find uploaded file type and show to contrroller
        $getFileTyper = $request->file('file_url_name')->extension();
        $getFileSizer = $request->file('file_url_name')->getSize();

         //started list of supported file trypes\
         $SupportedImageFiles = \collect(['jpeg','jpg','png','gif','tiff','raw'])->toArray();
         $SupportedArchiveFiles = \collect(['zip','rar','zz','shar','lbr','mar','tar','gz','lz','lzo','rz','xz'])->toArray();
         $SupportedVideoFiles = \collect(['mp4','m4a','m4v','f4v','f4a','m4b','m4r','f4b','mov','3gp','3gp2','ogg','oga','ogx','wmv','webm','flv','avi'])->toArray();
         $SupportedAudioFiles = \collect(['mp3','aa','aac','aax','act','aiff','amr','ape','dssgsmivsm4ammfmpcvox'])->toArray();
         $SupportedDocFiles = \collect(['doc','docx','html','html','odt','pdf','xls','xlsx','txt','ods','ppt','pptx'])->toArray();
         
        if(!empty($inputs['id'])) {
    		$files = Files::findOrFail($inputs['id']);
    	}
    	else
    	{
    		$files = new Files;
        }
        if(empty($inputs['id'])){
            $files->user_id = Auth::User()->id;
        } 
    	$files->file_name = $inputs['file_name'];
    	$files->file_type = $getFileTyper; 
    	$files->file_size = $getFileSizer; 
        //$files->file_type_name = '';
		//file for top 
        $st_file = $request->file('file_url_name');
        $st_file = Input::file('file_url_name'); 
		if(isset($st_file))
		 { 
            if (\in_array($getFileTyper, $SupportedImageFiles, true)) {
                $filename = 'files/images/'.time() . '_image_' . $st_file->getClientOriginalName();
                $fileFormat = public_path('files/images/'); 
                $st_file->move($fileFormat,$filename); 
                $UFileName = $filename; 
                $files->file_url_name = $filename;
                $files->file_type_name = 'images';
             }
             elseif (\in_array($getFileTyper, $SupportedVideoFiles, true)) {
                $filename = 'files/videos/'. time() . '_movie_' . $st_file->getClientOriginalName();
                $fileFormat = public_path('files/videos/'); 
                $st_file->move($fileFormat,$filename); 
                $UFileName = $filename; 
                $files->file_url_name = $filename;
                $files->file_type_name = 'videos';
             }
             elseif (\in_array($getFileTyper, $SupportedAudioFiles, true)) {
                $filename = 'files/audios/'. time() . '_audios_' . $st_file->getClientOriginalName();
                $fileFormat = public_path('files/audios/'); 
                $st_file->move($fileFormat,$filename); 
                $UFileName = $filename; 
                $files->file_url_name = $filename;
                $files->file_type_name = 'audios';
             }
             elseif (\in_array($getFileTyper, $SupportedArchiveFiles, true)) {
                $filename = 'files/archives/'. time() . '_archives_.' . $st_file->getClientOriginalName();
                $fileFormat = public_path('files/archives/'); 
                $st_file->move($fileFormat,$filename); 
                $UFileName = $filename; 
                $files->file_url_name = $filename;
                $files->file_type_name = 'archives';
             }
             elseif (\in_array($getFileTyper, $SupportedDocFiles, true)) {
                $filename = 'files/docs/'. time() . '_documets_.' . $st_file->getClientOriginalName();
                $fileFormat = public_path('files/docs/'); 
                $st_file->move($fileFormat,$filename); 
                $UFileName = $filename; 
                $files->file_url_name = $filename;
                $files->file_type_name = 'documents';
             }
             else {
                $filename = 'files/others/'. time() . '12.' . $st_file->getClientOriginalName();
                $fileFormat = public_path('files/others/'); 
                $st_file->move($fileFormat,$filename); 
                $UFileName = $filename; 
                $files->file_url_name = $filename;
                $files->file_type_name = 'others';
             }
        $files->save();

        if(!empty($inputs['id'])){
    		\Session::flash('warning', "You successfully changed file informations");
    		return \Redirect::back();
    	}
    	else {
    		\Session::flash('warning', "You successfully uploaded a new file!");
    		return \Redirect::back();
    	}            
    }
}
    public function editFiles($file_id)    
    {     
    	$filepost = Files::findOrFail($menu_id);
    	return view('files.get_files_by_types',compact('filepost'));
    } 
    public function delete($file_id)
    {
    	$filepost = Menus::findOrFail($menu_id);
    	$filepost->delete();
    	\Session::flash('warning', "You successfully deleted this file! But you won't able to recovery this file!");
    	return redirect()->back();
    }
}
