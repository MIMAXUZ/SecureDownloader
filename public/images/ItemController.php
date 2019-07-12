<?php

namespace Responsive\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use File;
use Image;
use URL;
use Mail;
use Carbon\Carbon;
use Session;
use Razorpay\Api\Api;
use Cookie;


class ItemController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	
	 public function call_translate($id,$lang) 
   {
   
    $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
     
   					
	if($lang == "en")
	{
	$translate = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->get();
					
		$translate_cnt = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->count();			
	}
	else
	{
	$translate = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->get();
					
		$translate_cnt = DB::table('avig_translate')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->count();			
	}				
	if(!empty($translate_cnt))
	{
					return $translate[0]->name;
	}
	else
	{
	  return "";
	}
}
	
	public function avigher_comment_reply(Request $request)
	{
	
	    $data = $request->all();
		$comm_user_id = $data['comm_user_id'];
		$item_user_id = $data['item_user_id'];
		$item_id = $data['item_id'];
		$item_token = $data['item_token'];
		
		
		   $codes =$data['comm_id'];
		
		
		$names = $data['comm_text_reply'];
		
		
		
		$comm_date = date("Y-m-d H:i:s");
		
		
		$comment_item = DB::table('product_comment')
						->where('comm_user_id','=',$comm_user_id)
						->where('item_id','=',$item_id)
						->count();
		
		if(empty($comment_item))
		{
		$rand_id = uniqid();
		}
		else
		{
		$commentitem = DB::table('product_comment')
						->where('comm_user_id','=',$comm_user_id)
						->where('item_id','=',$item_id)
						->get();
		$rand_id = 	$commentitem[0]->comm_group_id;			
		}
		
		foreach( $codes as $index => $code ) 
		{
		
		if($names[$index]!="")
		{
		
		DB::insert('insert into product_comment (item_id,item_token,comm_user_id,item_user_id,comm_text,comm_date,comm_group_id,comm_parent) values (?,?,?, ?,?,?,?, ?)', [$item_id,$item_token,$comm_user_id, $item_user_id,$names[$index],$comm_date,$rand_id,$code]);
		
		
		
		
		}
		}
		
		
		
		return back();
		
		
		
		
		
		
		
	}	
	
	
	
	public function avigher_refund_data(Request $request) 
	{
		
		$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		
		 $data = $request->all();
		 $set_id=1;
	     $setting = DB::table('settings')->where('id', $set_id)->get();
		 
		 $item_id = $data['item_id'];
		 $purchase_token = $data['purchase_token'];
		 $order_id = $data['order_id'];
		 $payment_date = $data['license_start_date'];
		 $buyer_id = $data['buyer_id'];
		 $vendor_id = $data['vendor_id'];
		 $payment = $data['payment'];
		 $subjected = $data['subject'];
		 $messaged = $data['message'];
		 $payment_type = $data['payment_type'];
		 $request_date = date("Y-m-d");
		 
		 $check = DB::table('product_refund')
		          ->where('purchase_token','=', $purchase_token)
				  ->where('order_id','=', $order_id)
				  ->where('buyer_id','=', $buyer_id)
				  ->where('vendor_id','=', $vendor_id)
				  ->count();
				  
		if(empty($check))
		{
		
		   DB::insert('insert into product_refund (purchase_token,request_date,order_id,item_id,payment_date,buyer_id,vendor_id,payment,payment_type,subject,message) values (?, ?, ?, ?, ?,  ?, ?, ?, ?, ?, ?)', [$purchase_token,$request_date,$order_id,$item_id,$payment_date,$buyer_id,$vendor_id,$payment,$payment_type,$subjected,$messaged]);
		   
		   
		   
		 $url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setting[0]->site_logo;
		
		$site_name = $setting[0]->site_name;
		
		$currency = $setting[0]->site_currency;
		
		
		
		$vendor_details = DB::table('users')
		 ->where('id', '=', $vendor_id)
		 ->get();
		
		$vendor_email = $vendor_details[0]->email;
		$vendor_name = $vendor_details[0]->name;
		$vendor_slug = $vendor_details[0]->user_slug;
		
		
		$buyer_details = DB::table('users')
		 ->where('id', '=', $buyer_id)
		 ->get();
		
		$buyer_email = $buyer_details[0]->email;
		$buyer_name = $buyer_details[0]->name;
		$buyer_slug = $buyer_details[0]->user_slug;
		
		
		
		$product_details = DB::table('products')
		 ->where('item_id', '=', $item_id)
		 ->get();
		 
		 
		 $item_slug = $product_details[0]->item_slug;
		 $item_title = $product_details[0]->item_title;
		
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->get();
		
		$admin_email = $admindetails[0]->email;
		$admin_name = $admindetails[0]->name;
		
		$check_sett_sname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		
		
		$datas = [
            'item_id' => $item_id, 'item_title' => $item_title, 'item_slug' => $item_slug, 'purchase_token' => $purchase_token, 'order_id' => $order_id, 'payment_date' => $payment_date, 'currency' => $currency, 'site_logo' => $site_logo, 'site_name' => $site_name, 'buyer_id' => $buyer_id, 'buyer_name' => $buyer_name, 'buyer_email' => $buyer_email, 'buyer_slug' => $buyer_slug, 'vendor_id' => $vendor_id, 'vendor_email' => $vendor_email, 'vendor_name' => $vendor_name, 'vendor_slug' => $vendor_slug, 'payment' => $payment, 'subjected' => $subjected, 'messaged' => $messaged, 'payment_type' => $payment_type, 'url' => $url
        ];
			
		/* vendor email */
		
			
			Mail::send('refund_email', $datas , function ($message) use ($admin_email,$vendor_email,$admin_name,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1006, $lang));
			
            $message->from($sett_sender_email,$sett_sender_name);

            $message->to($vendor_email);
			

        });    
		
		
		/* vendor email */  
		
		
		
		
		/* admin email */
		
		Mail::send('refund_email', $datas , function ($message) use ($admin_email,$vendor_email,$admin_name,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1006, $lang));
			
            $message->from($sett_sender_email,$sett_sender_name);

            $message->to($sett_sender_email);
			

        });    
		
		
		/* admin email */ 
		   
		  
	    return back()->with('refund_success', $this->call_translate( 1009, $lang));
		
		}
		else
		{
		
		 return back()->with('refund_error', $this->call_translate( 1012, $lang));
		
		}		  
				  
		 
		 	
	
	}
	
	
	
	
	
	
	
	
	
	public function avigher_comment_item(Request $request)
	{
	
	   $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	    $data = $request->all();
		$comm_user_id = $data['comm_user_id'];
		$item_user_id = $data['item_user_id'];
		$item_id = $data['item_id'];
		$item_token = $data['item_token'];
		
		$comm_id = $data['comm_id'];
		if(!empty($data['comm_text']))
		{
		  $comm_text = $data['comm_text'];
		}
		else
		{
		   $comm_text = "";
		}
		
		$comm_date = date("Y-m-d H:i:s");
		
		
		$comment_item = DB::table('product_comment')
						->where('comm_user_id','=',$comm_user_id)
						->where('item_id','=',$item_id)
						->count();
		
		if(empty($comment_item))
		{
		$rand_id = uniqid();
		}
		else
		{
		$commentitem = DB::table('product_comment')
						->where('comm_user_id','=',$comm_user_id)
						->where('item_id','=',$item_id)
						->get();
		$rand_id = 	$commentitem[0]->comm_group_id;			
		}
		
		
		DB::insert('insert into product_comment (item_id,item_token,comm_user_id,item_user_id,comm_text,comm_date,comm_group_id,comm_parent) values (?,?,?, ?,?,?,?, ?)', [$item_id,$item_token,$comm_user_id, $item_user_id,$comm_text,$comm_date,$rand_id,$comm_id]);
		
		
		if($comm_user_id != $item_user_id)
		{
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$admin_details = DB::table('users')
						->where('id','=',1)
				        ->get();
		$admin_name = $admin_details[0]->name;
		$admin_email = $admin_details[0]->email;
		
		$user_details = DB::table('users')
						->where('id','=',$comm_user_id)
				        ->get();				
			
		$user_email =  	$user_details[0]->email;
		$user_name =  	$user_details[0]->name;	
		$user_slug =  	$user_details[0]->user_slug;
		
		
		
		$item_user_details = DB::table('users')
						->where('id','=',$item_user_id)
				        ->get();
		
		$item_user_emailz = $item_user_details[0]->email;
		
		
		
		
		$item_details = DB::table('products')
						->where('item_id','=',$item_id)
				        ->get();
		
		$item_slug = $item_details[0]->item_slug;
		
		
		
		
		$check_sett_sname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
			
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name,  'admin_email' => $admin_email, 'user_email' => $user_email, 'user_name' => $user_name, 'url' => $url, 'comm_text' => $comm_text, 'user_slug' => $user_slug, 'item_id' => $item_id, 'item_slug' => $item_slug
        ];
		
		Mail::send('comment_email', $datas , function ($message) use ($admin_email, $admin_name, $sett_sender_name, $sett_sender_email,$lang, $item_user_emailz)
        {
            $message->subject($this->call_translate( 1015, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($item_user_emailz);

        }); 
		
		
		
		
		}
		
		
		
		
		return back();
		
		
	}	
	
	
	
	
	public function avigher_report_item(Request $request)
	{
	
	   $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		$data = $request->all();
		
		$report_category = $data['report_category'];
		$report_message = $data['report_message'];
		$report_user_id = $data['report_user_id'];
		$item_user_id = $data['item_user_id'];
		$item_id = $data['item_id'];
		
		
		
		$check_report = DB::table('product_report')
	              ->where('item_id','=',$item_id)
				  ->where('report_user_id','=',$report_user_id)
		           ->count();
		
		if(empty($check_report))
		{
		DB::insert('insert into product_report (item_id,item_user_id,report_user_id,report_category,reason_for_report) values (?,?,?, ?,?)', [$item_id,$item_user_id,$report_user_id,$report_category,$report_message]);
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminer = DB::table('users')
		->where('id', '=', 1)
		->get();
		
		$admin_email = $adminer[0]->email;
		$admin_name = $adminer[0]->name;
		
		
		
		$check_sett_sname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		$item_details_count = DB::table('products')
	              ->where('item_id','=',$item_id)
				  ->count();
		if(!empty($item_details_count))
		{
		   $item_details = DB::table('products')
	              ->where('item_id','=',$item_id)
				  ->get();
		   $item_slug = $item_details[0]->item_slug;
		}
		else
		{
		   $item_slug = "";
		}
		
		$reporter = DB::table('users')
	              
				  ->where('id','=',$report_user_id)
		           ->get();		 
				    
		$reporter_name = $reporter[0]->name;
			
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'url' => $url, 'item_slug' => $item_slug, 'reporter_name' => $reporter_name, 'item_id' => $item_id, 'report_category' => $report_category, 'report_message' => $report_message
        ];
		
		Mail::send('report_email', $datas , function ($message) use ($admin_email,$admin_name,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1098, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		return redirect()->back()->with('success', $this->call_translate( 1125, $lang));
		
		
		}
		else
		{
		
		return redirect()->back()->with('error', $this->call_translate( 1116, $lang));
		
		}
		
	
	}
	
	
	
	
	public function avigher_support_item(Request $request)
	{
	
	   $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	  
	    $data = $request->all();
		$buyer_name = $data['buyer_name'];
		$buyer_email = $data['buyer_email'];
		$vendor_name = $data['vendor_name'];
		$vendor_email = $data['vendor_email'];
		$support_message = $data['support_message'];
		
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		$adminer = DB::table('users')
		->where('id', '=', 1)
		->get();
		
		$admin_email = $adminer[0]->email;
		$admin_name = $adminer[0]->name;
		
		
		
		$check_sett_sname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		
		
			
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'buyer_name' => $buyer_name,  'buyer_email' => $buyer_email, 'vendor_name' => $vendor_name, 'vendor_email' => $vendor_email, 'url' => $url, 'support_message' => $support_message
        ];
		
		Mail::send('support_email', $datas , function ($message) use ($admin_email,$admin_name,$vendor_email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1018, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($vendor_email);

        }); 
		
		
		return redirect()->back()->with('support_success', $this->call_translate( 1021, $lang));
		
		
		
		
		
		
	
	}
	
	
	
	
	
	
	public function avigher_item_checkout(Request $request)
	{
	$url = URL::to("/");
	
	
	$countries_count = DB::table('country')
		->orderBy('country_name', 'asc')
		->count();
	
	

	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	
	$data = $request->all();
	 $log_id = Auth::user()->id;
	 
	 
	 
	 if(!empty($data['bill_firstname'])){ $bill_firstname = $data['bill_firstname']; } else { $bill_firstname = ""; }
	 if(!empty($data['bill_lastname'])){ $bill_lastname = $data['bill_lastname']; } else { $bill_lastname = ""; }
	 if(!empty($data['bill_companyname'])){ $bill_companyname = $data['bill_companyname']; } else { $bill_companyname = ""; }
	 if(!empty($data['bill_email'])){ $bill_email = $data['bill_email']; } else { $bill_email = ""; }
	 if(!empty($data['bill_phone'])){ $bill_phone = $data['bill_phone']; } else { $bill_phone = ""; }
	 if(!empty($data['bill_country'])){ $bill_country = $data['bill_country']; } else { $bill_country = ""; }
	  if(!empty($data['bill_address'])){ $bill_address = $data['bill_address']; } else { $bill_address = ""; }
	  if(!empty($data['bill_city'])){ $bill_city = $data['bill_city']; } else { $bill_city = ""; }
	  if(!empty($data['bill_state'])){ $bill_state = $data['bill_state']; } else { $bill_state = ""; }
	  if(!empty($data['bill_postcode'])){ $bill_postcode = $data['bill_postcode']; } else { $bill_postcode = ""; }
	  if(!empty($data['enable_ship'])){ $enable_ship = $data['enable_ship']; } else { $enable_ship = ""; }
	  if(!empty($data['ship_firstname'])){ $ship_firstname = $data['ship_firstname']; } else { $ship_firstname = ""; }
	   if(!empty($data['ship_lastname'])){ $ship_lastname = $data['ship_lastname']; } else { $ship_lastname = ""; }
	   if(!empty($data['ship_companyname'])){ $ship_companyname = $data['ship_companyname']; } else { $ship_companyname = ""; }
	   if(!empty($data['ship_email'])){ $ship_email = $data['ship_email']; } else { $ship_email = ""; }
	   if(!empty($data['ship_phone'])){ $ship_phone = $data['ship_phone']; } else { $ship_phone = ""; }
	   if(!empty($data['ship_country'])){ $ship_country = $data['ship_country']; } else { $ship_country = ""; }
	   if(!empty($data['ship_address'])){ $ship_address = $data['ship_address']; } else { $ship_address = ""; }
	   if(!empty($data['ship_city'])){ $ship_city = $data['ship_city']; } else { $ship_city = ""; }
	   if(!empty($data['ship_state'])){ $ship_state = $data['ship_state']; } else { $ship_state = ""; }
	   if(!empty($data['ship_postcode'])){ $ship_postcode = $data['ship_postcode']; } else { $ship_postcode = ""; }
	   if(!empty($data['order_comments'])){ $order_comments = $data['order_comments']; } else { $order_comments = ""; }
	   if(!empty($data['payment_type'])){ $payment_type = $data['payment_type']; } else { $payment_type = ""; }
	  
	
	
	$purchase_token = rand(1111111,9999999);
	$token = csrf_token();
	$payment_date =  date("Y-m-d");
	 $order_id = $data['order_id'];
	 $item_prices = base64_decode($data['item_prices']);
	$total = base64_decode($data['total']);
	$item_user_id = $data['item_user_id'];
	
	
	$commission_amt = $setts[0]->commission_amt;
    $commission_mode = $setts[0]->commission_mode;
		
		
		          if($commission_mode=="percentage")
				   {
					   $commission_amount = ($commission_amt * $total) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($total < $commission_amt)
						{
							$commission_amount = 0;
						}
						else
						{
							$commission_amount = $commission_amt;
						}
				   }
				   
	$vendor_amount = $total - $commission_amount;
	
	$admin_amount = $commission_amount;
	
	$check_checkout = DB::table('product_checkout')
	                  ->where('token','=',$token)
					  ->where('payment_status','=','pending')
		              ->count();
					  
					  
	if(empty($check_checkout))
	{
		DB::insert('insert into product_checkout (
		purchase_token,token,ord_id, 
		item_prices,item_user_id,user_id,
		total,vendor_amount,admin_amount,payment_type,payment_date,
		bill_firstname,bill_lastname,bill_companyname,
		bill_email,bill_phone,bill_country,
		bill_address,bill_city,bill_state,
		bill_postcode,enable_ship,ship_firstname,
		ship_lastname,ship_companyname,ship_email,
		ship_phone,ship_country,ship_address,
		ship_city,ship_state,ship_postcode,
		other_notes,payment_status) values (?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?,?, ?,?, ?,?)', [$purchase_token,$token,$order_id, $item_prices,$item_user_id,$log_id, $total,$vendor_amount,$admin_amount,$payment_type,$payment_date, $bill_firstname,$bill_lastname,$bill_companyname, $bill_email,$bill_phone,$bill_country, $bill_address,$bill_city,$bill_state, $bill_postcode,$enable_ship,$ship_firstname, $ship_lastname,$ship_companyname,$ship_email, $ship_phone,$ship_country,$ship_address, $ship_city,$ship_state,$ship_postcode, $order_comments,'pending']);
	}
	else
	{
	
	
	
	DB::update('update product_checkout set 
	purchase_token="'.$purchase_token.'",
	ord_id="'.$order_id.'",
	item_prices="'.$item_prices.'",
	item_user_id="'.$item_user_id.'",
	total="'.$total.'",
	vendor_amount="'.$vendor_amount.'",
	admin_amount="'.$admin_amount.'",
	payment_type="'.$payment_type.'",
	payment_date="'.$payment_date.'",
	bill_firstname="'.$bill_firstname.'",
		bill_lastname="'.$bill_lastname.'",
		bill_companyname="'.$bill_companyname.'",
		bill_email="'.$bill_email.'",
		bill_phone="'.$bill_phone.'",
		bill_country="'.$bill_country.'",
		bill_address="'.$bill_address.'",
		bill_city="'.$bill_city.'",
		bill_state="'.$bill_state.'",
		bill_postcode="'.$bill_postcode.'",
		enable_ship="'.$enable_ship.'",
		ship_firstname="'.$ship_firstname.'",
		ship_lastname="'.$ship_lastname.'",
		ship_companyname="'.$ship_companyname.'",
		ship_email="'.$ship_email.'",
		ship_phone="'.$ship_phone.'",
		ship_country="'.$ship_country.'",
		ship_address="'.$ship_address.'",
		ship_city="'.$ship_city.'",
		ship_state="'.$ship_state.'",
		ship_postcode="'.$ship_postcode.'",
		other_notes="'.$order_comments.'"
	    where payment_status="pending" and token = ?', [$token]);
	
	}				  
					  
	DB::update('update product_orders set purchase_token="'.$purchase_token.'" where status="pending" and user_id = ?', [$log_id]);
	
	
	
	 $currency  = $setts[0]->site_currency;
	$paypal_url = $setts[0]->paypal_url;
	$paypal_id = $setts[0]->paypal_id;
	$order_no = $purchase_token;
	
	$amount = $total;
	$login_user = Auth::user()->id;
	
	$view_count = DB::table('product_orders')
						->where('purchase_token', '=', $purchase_token)
						->count();
	if(!empty($view_count))
	{					
	    $view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $purchase_token)
						->get();
	
		foreach($view_orders as $views)
		{
		
		$prod_user_id = $views->item_user_id;
		$vendor_amount = $views->price;
		$item_id = $views->item_id;
		$view_item = DB::table('products')
						->where('item_id', '=', $item_id)
						->get();
		$itemname = $view_item[0]->item_title;				
		
		if($commission_mode=="percentage")
				   {
					   $commiss_amount = ($commission_amt * $vendor_amount) / 100;
				   }
				   if($commission_mode=="fixed")
				   {
					    if($views->price < $commission_amt)
						{
							$commiss_amount = 0;
						}
						else
						{
							$commiss_amount = $commission_amt;
						}
				   }
		
		$vendor_final_amt = $vendor_amount - $commiss_amount;		   
		$admin_final_amount = $commiss_amount;
		
		
			DB::update('update product_orders set item_name="'.$itemname.'",vendor_amount="'.$vendor_final_amt.'",admin_amount="'.$admin_final_amount.'",total="'.$vendor_amount.'" where user_id="'.$login_user.'" and ord_id = ?', [$views->ord_id]); 		
		    
		
		
		}
		
	}
	
	
	/* Razorpay */
	
	if($payment_type == "razorpay")
	{
	
	
	$check_sett_razor = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->count();
		if(!empty($check_sett_razor))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->get();
			$sett_razor_item = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_razor_item = "";
			}	
		}
		else
		{
		  $sett_razor_item = "";
		}
		
		
	  
	  
	  $check_secret_razor = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->count();
		if(!empty($check_secret_razor))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->get();
			$sett_razor_secret = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_razor_secret = "";
			}	
		}
		else
		{
		  $sett_razor_secret = "";
		}
		
	 
	$log_detailer = DB::table('users')
		->where('id', '=', $login_user)
		->get();
	 
	 
	 include(app_path() . '/razorpay-php/Razorpay.php');
	 
	 $api = new Api($sett_razor_item, $sett_razor_secret);
	 
	 $razor_amount = $amount;
    
	 $receipt = rand(11111,99999);

		$orderData = [
			'receipt'         => $receipt,
			'amount'          => $razor_amount * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture sara
		];
	 
    $razorpayOrder = $api->order->create($orderData);
	
	$razorpayOrderId = $razorpayOrder['id'];
	
	Session::put('razorpay_order_id', $razorpayOrderId);
	
	$displayAmount = $razor_amount = $orderData['amount'];
	
	$displayCurrency = $setts[0]->site_currency;
	
	$details_namer = $bill_firstname.' '.$bill_lastname;
	
	$razordata = [
			"key"               => $sett_razor_item,
			"amount"            => $razor_amount,
			"name"              => $bill_firstname,
			"description"       => $bill_companyname,
			"image"             => $url.'/local/images/media/'.$setts[0]->site_logo,
			"prefill"           => [
			"name"              => $details_namer,
			"email"             => $log_detailer[0]->email,
			"contact"           => $log_detailer[0]->phone,
			],
			"notes"             => [
			"address"           => $bill_address,
			"merchant_order_id" => $purchase_token,
			],
			"theme"             => [
			"color"             => "#F37254"
			],
			"order_id"          => $razorpayOrderId,
		];
		
		
			/*$razordata['display_currency']  = 'INR';*/
			$razordata['display_amount']    = $razor_amount;
		    
		
		   $json_value = json_encode($razordata);
      }
	  else
	  {
	     $json_value = "";
	  }

	 /* Razorpay */
	
	
	
	
	
	 $ddata = array('countries_count' => $countries_count, 'amount' => $amount, 'currency' => $currency, 'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'order_no' => $order_no, 'payment_type' => $payment_type, 'view_count' => $view_count, 'json_value' => $json_value, 'bill_city' => $bill_city, 'bill_state' => $bill_state, 'bill_postcode' => $bill_postcode, 'bill_country' => $bill_country, 'bill_address' => $bill_address);
	   
	   return view('payment-details')->with($ddata);
	
	
	
	}
	
	
	
	
	
	
	
	
	public function avigher_review_data(Request $request) 
	{
		 $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		 
		 $data = $request->all();
	     $rating = $data['rating'];
		 $review = $data['review'];
		 
		 $user_id = $data['user_id'];
		 $item_id = $data['item_id'];
		
		 $today = date("Y-m-d H:i:s");
		
		
		 
		 $check = DB::table('product_rating')
		          ->where('user_id','=', $user_id)
				  ->where('item_id','=', $item_id)
				  ->count();
				  
		if(empty($check))
		{
		    DB::insert('insert into product_rating (user_id,item_id,rating,review,review_date) values (?, ?, ?, ?, ?)', [$user_id,$item_id,$rating,$review,$today]);
		
		}
		else
		{
		   DB::update('update product_rating set rating="'.$rating.'",review="'.$review.'",review_date="'.$today.'" where user_id="'.$user_id.'" and item_id = ?', [$item_id]);
		}
				  
		
		 
		 return back()->with('success', $this->call_translate( 1024, $lang));
		 
		 
		 
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function avigher_view_checkout()
	{
	
	
	$countries_count = DB::table('country')
		->orderBy('country_name', 'asc')
		->count();
	
	
	
	if(Auth::check()) {
	   $log_id = Auth::user()->id;
	   
	   $cart_views_count = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->count();
	   
	   
	   $cart_views = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->get();
		
		}
		else
		{
		$cart_views_count = 0;
		$cart_views = "";
		
		}
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$admin_details = DB::table('users')
						 ->where('id', '=', 1)
						 ->get();
	
	
	
	
	 $data = array('cart_views_count' => $cart_views_count, 'cart_views' => $cart_views, 'setts' => $setts, 'admin_details' => $admin_details, 'countries_count' => $countries_count);
	 
	   
	   return view('checkout')->with($data);
	
	
	}
	
	
	
	
	
	public function avigher_view_cart()
	{
	   if(Auth::check()) {
	   $log_id = Auth::user()->id;
	   
	   $cart_views_count = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->count();
	   
	   
	   $cart_views = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->get();
		
		}
		else
		{
		$cart_views_count = 0;
		$cart_views = "";
		
		}
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$admin_details = DB::table('users')
						 ->where('id', '=', 1)
						 ->get();
		
		
		
	   
	    $data = array('cart_views_count' => $cart_views_count, 'cart_views' => $cart_views, 'setts' => $setts, 'admin_details' => $admin_details);
	   
	   return view('cart')->with($data);
	}
	
	
	
	
	
	
	
	public function avigher_item_cart(Request $request)
	{
	   $data = $request->all();
	   
	   $user_id = $data['user_id'];
	   $item_id = $data['item_id'];
	   $item_token = $data['item_token'];
	   $item_user_id = $data['item_user_id'];
	  
	   if(!empty($data['support_price']))
	   {
	   $two_type = explode("_", $data['support_price']);
	   $price = $two_type[0];
	   $checked = $two_type[1];
	      if($checked==1)
	      {
		     $licence = "regular_price_six_month";
		  }
		  else if($checked==2)
	      {
		     $licence = "regular_price_one_year";
		  }
		  else if($checked==3)
	      {
		     $licence = "extended_price_six_month";
		  }
		  else if($checked==4)
	      {
		     $licence = "extended_price_one_year";
		  }
	   
	   }
	   else
	   {
	       $price = 0;
		   $licence = "";
		   
	   }
	   $status = "pending";
	   
	   
	   $check = DB::table('product_orders')
						  ->where('user_id','=',$user_id)
						   ->where('item_id','=',$item_id)
						   ->where('status','=',$status)
						   ->count();
	   
	   if(empty($check))
	   {
	    DB::insert('insert into product_orders (user_id,item_id,item_user_id,item_token,licence_type,price,total,status) values (?, ?, ?, ?, ?,?,?,?)', [$user_id,$item_id,$item_user_id,$item_token,$licence,$price,$price,$status]);
	   }
	   else
	   {
		DB::update('update product_orders set licence_type="'.$licence.'",price="'.$price.'"  where user_id="'.$user_id.'" and status="'.$status.'" and item_id = ?', [$item_id]);
	   }
		
		return redirect('/cart');
	   
	   
	   
	
	
	}
	
	
	
	
	public function avigher_remove_cart($token)
	{
	
	   DB::delete('delete from product_orders where ord_id = ?',[$token]);
	   return redirect('/cart');
	}
	
	
	public function view_like_item($id,$slug,$like)
	{
	  $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	  
	  $logged = Auth::user()->id;
	  $get_viewer = DB::table('product_liked')
		            ->where('item_id','=',$id)
					->where('user_id','=',$logged)
					->count();
		if(empty($get_viewer))
		{
		     $get_data = DB::table('products')
		            ->where('item_id','=',$id)
					->get();
			$like_data = $get_data[0]->liked + 1;
			
			DB::update('update products set liked="'.$like_data.'" where item_id = ?', [$id]);
			DB::insert('insert into product_liked (item_id,user_id) values (?, ?)', [$id,$logged]);
			return back()->with('success', 'Thanks for your likes');		
		}
		else
		{
		  return back()->with('error', $this->call_translate( 1027, $lang));
		}			
	
	}
	
	
	
	public function view_add_item()
    {
	
	
	$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
     
		$language = DB::table('avig_language')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();			
	 $category_count = DB::table('category')
		            ->where('delete_status','=','')
					->where('cat_type','=','default')
					->where('lang_code','=',$lang)
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();
					
	$framework_count = DB::table('category')
		            ->where('delete_status','=','')
					->where('cat_type','=','framework')
					->where('lang_code','=',$lang)
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();				
					
	
	return view('add-item', ['category_count' => $category_count, 'framework_count' => $framework_count, 'language' => $language]);
	}
	
	
	public function view_edit_item($token)
	{
	
	$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }			
	
	$settings = DB::select('select * from settings where id = ?',[1]);
	$viewcount = DB::table('products')
		            ->where('item_token','=',$token)
					->count();
	
	$edit = DB::table('products')
		            ->where('item_token','=',$token)
					->get();
					
	$browser = array("IE6","IE7","IE8","IE9","IE10","IE11","Firefox","Safari","Opera","Chrome","Edge");	
	
	
	 $category_count = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->where('lang_code','=',$lang)
					->where('cat_type','=','default')
					->orderBy('cat_name', 'asc')->count();	
					
	$framework_count = DB::table('category')
		            ->where('delete_status','=','')
					->where('cat_type','=','framework')
					->where('lang_code','=',$lang)
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->count();				
					
	   /* item meta */
		$check_item_meta = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
		if(!empty($check_item_meta))
		{
		   
		    $item_meta_well = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
				
			if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->get();
			$video_status = $item_meta[0]->item_meta_value;
			}
			else
			{
			$video_status = "";
			}	
		}
		else
		{
		  $video_status = "";
		}
		
		
		
		
		
		
		
		
		$check_item_free = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
		if(!empty($check_item_free))
		{
		   
		    $item_meta_wells = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
				
			if(!empty($item_meta_wells))
			{	
		   $item_meta = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_type")
		        
				->get();
			$free_status = $item_meta[0]->item_meta_value;
			}
			else
			{
			$free_status = "";
			}	
		}
		else
		{
		  $free_status = "";
		}
		/* item meta */
						
					
		$language = DB::table('avig_language')
		            ->where('lang_status', '=', 1)
					->orderBy('id','asc')
					->get();			
					
					
							
					
	return view('edit-item', ['edit' => $edit, 'settings' => $settings, 'viewcount' => $viewcount, 'browser' => $browser, 'category_count' => $category_count, 'video_status' => $video_status, 'framework_count' => $framework_count, 'free_status' => $free_status, 'language' => $language]);
	
	}
	
	
	
	public function featured_success($token)
	{
	$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$featured_days = $setts[0]->featured_days;
		$featured_price = $setts[0]->featured_price;
		$payment_type="paypal";
	$get_record = DB::table('products')
				  ->where('item_token', '=', $token)
				  ->get();
	
	$start_date = date("Y-m-d");
	$end_date = date('Y-m-d', strtotime(' + '.$featured_days.' days'));
	
	
	$orderupdate = DB::table('products')
						->where('item_token', '=', $token)
						
						->update(['item_featured' => 1, 'featured_startdate' => $start_date, 'featured_enddate' => $end_date, 'featured_days' => $featured_days,      'featured_price' => $featured_price, 'featured_payment_type' => $payment_type]);
		 
	
				   
				   
				   
			$user_details = DB::table('users')
              
			       ->where('id', '=', $get_record[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $token;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $featured_price;
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		
		$check_sett_sname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id, 'featured_days' => $featured_days
        ];
		
		Mail::send('featured_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1030, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('featured_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1030, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		
		
		
		
		
	 
	  $data = array('token' => $token);
      return view('feature_success')->with($data);
	
	
	}
	
	
	public function delete_items($token)
	{
	
	
	DB::update('update products set delete_status="deleted" where item_token = ?', [$token]);
	
	return back();
	
	
	}
	
	
	public function view_items()
	{
	
	   $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }	
	    $logged = Auth::user()->id;
	   $items_count = DB::table('products')
		            ->where('delete_status','=','')
					->where('user_id','=',$logged)
					->where('lang_code','=',$lang)
					->orderBy('item_id', 'desc')
					->count();
	   $settings = DB::select('select * from settings where id = ?',[1]);
	   return view('my-items', ['items_count' => $items_count, 'settings' => $settings]);
	
	}
	
	
	
	
	public function view_shopping()
	{
	    $logged = Auth::user()->id;
		$today_date = date("Y-m-d");
		$url = URL::to("/");
        $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	   $items_count = DB::table('product_orders')
		            ->where('user_id','=',$logged)
					->where('status','=','completed')
					->where('license_end_date', '>=', $today_date)
					->orderBy('ord_id', 'desc')
					->count();
	   $settings = DB::select('select * from settings where id = ?',[1]);
	   return view('my-shopping', ['items_count' => $items_count, 'settings' => $settings, 'setts' => $setts, 'url' => $url]);
	
	}
	
	
	
	public function view_orders()
	{
	    $logged = Auth::user()->id;
		$today_date = date("Y-m-d");
		$url = URL::to("/");
        $setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
	   $items_count = DB::table('product_orders')
		            ->where('item_user_id','=',$logged)
					->where('status','=','completed')
					->where('license_end_date', '>=', $today_date)
					->orderBy('ord_id', 'desc')
					->count();
	   $settings = DB::select('select * from settings where id = ?',[1]);
	   return view('my-orders', ['items_count' => $items_count, 'settings' => $settings, 'setts' => $setts, 'url' => $url]);
	
	}
	
	
	
	public function view_orders_details($ord_id)
	{
	
	$logged = Auth::user()->id;
	$items_count = DB::table('product_orders')
		            ->where('ord_id','=',$ord_id)
					->where('status','=','completed')
					->count();
					
	if(!empty($items_count))
	{				
	$items = DB::table('product_orders')
		            ->where('ord_id','=',$ord_id)
					->where('status','=','completed')
					->get();
					
					
	$user_detail = DB::table('users')
		            ->where('id','=',$items[0]->user_id)
					->where('delete_status','=','')
					->get();
					
	
	$checkout_detail = DB::table('product_checkout')
		            ->where('purchase_token','=',$items[0]->purchase_token)
					->where('payment_status','=','completed')
					->get();								
					
						
	}							
					
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();				
	
	
	return view('view-order-details', ['items_count' => $items_count, 'setts' => $setts, 'items' => $items, 'user_detail' => $user_detail, 'checkout_detail' => $checkout_detail]);
	
	
	}
	
	
	
	
	public function view_download_details($item_id,$ord_id)
	{
	   $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	   
	   $url = URL::to("/");
	
	   $order_count = DB::table('product_orders')
		            ->where('ord_id','=',$ord_id)
					->get();
					
		$downloaded_stock = $order_count[0]->downloaded_count;
		
		$item_count = DB::table('products')
		            ->where('item_id','=',$item_id)
					->get();
					
		$limited_stock = $item_count[0]->unlimited_download;
		$cound_file = $downloaded_stock + 1;
		$agin_file = $item_count[0]->downloaded + 1;
		
		if(!empty($limited_stock))
		{
			if($limited_stock > $downloaded_stock)
			{
			   
			   DB::update('update product_orders set downloaded_count="'.$cound_file.'" where ord_id = ?', [$ord_id]);
			   DB::update('update products set downloaded="'.$agin_file.'" where item_id = ?', [$item_id]);
			   return redirect($url.'/local/images/media/'.$item_count[0]->main_file);
			 
			   
			}
			else
			{
			
			 return back()->with('down_error', $this->call_translate( 1033, $lang));
			
			}	
			
			
								
	    }
		else
		{
		   DB::update('update products set downloaded="'.$agin_file.'" where item_id = ?', [$item_id]);
		   return redirect($url.'/local/images/media/'.$item_count[0]->main_file);
		}
		
		
		
		
		
	
	}
	
	
	
	public function view_shopping_details($ord_id)
	{
	
	$logged = Auth::user()->id;
	$items_count = DB::table('product_orders')
		            ->where('ord_id','=',$ord_id)
					->where('status','=','completed')
					->count();
					
	if(!empty($items_count))
	{				
	$items = DB::table('product_orders')
		            ->where('ord_id','=',$ord_id)
					->where('status','=','completed')
					->get();
					
					
	$user_detail = DB::table('users')
		            ->where('id','=',$items[0]->item_user_id)
					->where('delete_status','=','')
					->get();
					
	
	$checkout_detail = DB::table('product_checkout')
		            ->where('purchase_token','=',$items[0]->purchase_token)
					->where('payment_status','=','completed')
					->get();								
					
						
	}							
					
	$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();				
	
	
	return view('view-shopping-details', ['items_count' => $items_count, 'setts' => $setts, 'items' => $items, 'user_detail' => $user_detail, 'checkout_detail' => $checkout_detail]);
	
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function duplicate_items($token)
	{
	    $logged = Auth::user()->id;
		
		
		$record = DB::table('products')->where('user_id','=',$logged)->where('item_token','=',$token)->first();
        $rows = $record->replicate();
        $rows->save();
        

		
		
		return view('my-items');
    }		
	
	
	
	public function view_featured($token)
	{
	
	
	$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
	
	$items_count = DB::table('products')
		            ->where('delete_status','=','')
					->where('lang_code','=',$lang)
					->where('item_token','=',$token)
					->count();
	
	
	$items_details = DB::table('products')
		            ->where('delete_status','=','')
					->where('lang_code','=',$lang)
					->where('item_token','=',$token)
					->get();
	
	
	$settings = DB::select('select * from settings where id = ?',[1]);
	
	return view('featured', ['settings' => $settings, 'items_details' => $items_details, 'items_count' => $items_count]);
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function clean($string) 
	{
    
     $string = preg_replace("/[^\p{L}\/_|+ -]/ui","",$string);

    
    $string = preg_replace("/[\/_|+ -]+/", '-', $string);

    
    $string =  trim($string,'-');

    return mb_strtolower($string);
	} 
	
	
	
	
	
	public function avigher_featured_payment(Request $request)
	{
	       $url = URL::to("/");
	       $data = $request->all();
		   $settings = DB::select('select * from settings where id = ?',[1]);
		   
		   $amount = $data['price'];
		   $duration = $data['duration'];
		   $item_name = $data['item_name'];
		   $item_number = $data['item_number'];	
		   $currency = 	$settings[0]->site_currency;
		   $payment_type = 	$data['payment_type']; 
		   $paypal_id =  $settings[0]->paypal_id;
		   $paypal_url =  $settings[0]->paypal_url;
		   
		   
		   /* Razorpay */
	
	$check_sett_razor = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->count();
		if(!empty($check_sett_razor))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->get();
			$sett_razor_item = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_razor_item = "";
			}	
		}
		else
		{
		  $sett_razor_item = "";
		}
		
		
	  
	  
	  $check_secret_razor = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->count();
		if(!empty($check_secret_razor))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->get();
			$sett_razor_secret = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_razor_secret = "";
			}	
		}
		else
		{
		  $sett_razor_secret = "";
		}
		
	 $login_user = Auth::user()->id;
	$log_detailer = DB::table('users')
		->where('id', '=', $login_user)
		->get();
	 
	 
	 include(app_path() . '/razorpay-php/Razorpay.php');
	 
	 $api = new Api($sett_razor_item, $sett_razor_secret);
	 
	 $razor_amount = $amount;
    
	 $receipt = rand(11111,99999);

		$orderData = [
			'receipt'         => $receipt,
			'amount'          => $razor_amount * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'payment_capture' => 1 // auto capture sara
		];
	 
    $razorpayOrder = $api->order->create($orderData);
	
	$razorpayOrderId = $razorpayOrder['id'];
	
	Session::put('razorpay_order_id', $razorpayOrderId);
	
	$displayAmount = $razor_amount = $orderData['amount'];
	
	$displayCurrency = $settings[0]->site_currency;
	
	$details_namer = $log_detailer[0]->name;
	
	$razordata = [
			"key"               => $sett_razor_item,
			"amount"            => $razor_amount,
			"name"              => $details_namer,
			"description"       => '',
			"image"             => $url.'/local/images/media/'.$settings[0]->site_logo,
			"prefill"           => [
			"name"              => $log_detailer[0]->name,
			"email"             => $log_detailer[0]->email,
			"contact"           => $log_detailer[0]->phone,
			],
			"notes"             => [
			"address"           => '',
			"merchant_order_id" => $item_number,
			],
			"theme"             => [
			"color"             => "#F37254"
			],
			"order_id"          => $razorpayOrderId,
		];
		
		
			/*$razordata['display_currency']  = 'INR';*/
			$razordata['display_amount']    = $razor_amount;
		    
		
		   $json_value = json_encode($razordata);


	 /* Razorpay */
	
	
		   
		   
		   
		   
		   $ddata = array('amount' => $amount, 'currency' => $currency, 'paypal_url' => $paypal_url, 'paypal_id' => $paypal_id, 'item_number' => $item_number, 'payment_type' => $payment_type, 'item_name' => $item_name, 'settings' => $settings, 'duration' => $duration, 'json_value' => $json_value);
            return view('featured-payment')->with($ddata);  
	
	
	}
	
	
	
	public function avigher_add_items(Request $request)
	{
	
	 $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	$userid = Auth::user()->id;
	
	/*$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();
			*/
	
	
		
		
	
	
	   $data = $request->all();
	   
	   
	   
	   
	   
	   $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		  $imgtype = $settings[0]->image_type;
		 $zipsize = $settings[0]->zip_size;
		 $mp3size = $settings[0]->mp3_size;
		
		$rules = array(
		
		
		'item_desc' => 'required',
		'main_file' => 'max:'.$zipsize.'|mimes:zip',
		'video_file' => 'max:'.$mp3size.'|mimes:mp4',
		'preview_image' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'item_thumbnail' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'image.*' => 'image|mimes:'.$ .'|max:'.$imgsize
		
		);
		
		
		$messages = array(
            
            'preview_image' => 'The :attribute field must only be image'
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
	   
	   
	   if(!empty($data['item_title']))
	   {
	   $item_title = $data['item_title'];
	   }
	   else
	   {
	   $item_title = "";
	   }
	   
	   $item_slug = $data['item_slug'];
	   
	   
	   if(!empty($data['item_category']))
	   {
		   $cat_id = $data['item_category'];
		   $category_id = "";
		   foreach($cat_id as $category)
		   {
			  $category_id .= $category.',';
		   }
		   
		   $categoryid = rtrim($category_id, ",");
	   }
	   else
	   {
	      $categoryid = "";
	   }
	   
	   
	   if(!empty($data['item_framework']))
	   {
		   $cat_id = $data['item_framework'];
		   $framework_id = "";
		   foreach($cat_id as $category)
		   {
			  $framework_id .= $category.',';
		   }
		   
		   $frameworkid = rtrim($framework_id, ",");
	   }
	   else
	   {
	      $frameworkid = "";
	   }
	   
	   
	   
	   
	   
	   if(!empty($data['item_desc']))
	   {
	   $item_desc = $data['item_desc'];
	   }
	   else
	   {
	   $item_desc = "";
	   }
	   
	   
	   
	   $item_type = $data['item_type'];
	   
	   
	  
	   if(!empty($data['regular_price_six_month']))
	   { 
	   $regular_price_six_month = $data['regular_price_six_month'];
	   }
	   else
	   {
	     $regular_price_six_month = 0; 
	   }
	   
	   
	   if(!empty($data['regular_price_one_year']))
	   {
	   $regular_price_one_year = $data['regular_price_one_year'];
	   }
	   else
	   {
	   $regular_price_one_year = 0;
	   }
	   
	   if(!empty($data['extended_price_six_month']))
	   {
	   $extended_price_six_month = $data['extended_price_six_month'];
	   }
	   else
	   {
	   $extended_price_six_month = 0;
	   }
	   
	   if(!empty($data['extended_price_one_year']))
	   {
	   $extended_price_one_year = $data['extended_price_one_year'];
	   }
	   else
	   {
	     $extended_price_one_year = 0;
	   }
	   
	   $high_resolution = $data['high_resolution'];
	   
	   $compatible_browser = "";
	   foreach($data['compatible_browser'] as $compatible)
	   {
	   
	      $compatible_browser .= $compatible.',';
	   
	   }
	   $compatiblebrowser = rtrim($compatible_browser,',');
	   
	   $file_included = $data['file_included'];
	   
	   
	   
	   $token = $data['item_token'];
	   
	   
	   if(!empty($data['demo_url']))
	   {
	   $demo_url = $data['demo_url'];
	   }
	   else
	   {
	   $demo_url = "";
	   }
	   
	   
	   
	   
	    
	   $support_item = $data['support_item'];
	   
	   
	   
	   $future_update = $data['future_update'];
	   
	   
	   
	   if(!empty($data['unlimited_download']))
	   {
	   
	   $unlimited_download = $data['unlimited_download'];
	   
	   }
	   else
	   {
	    $unlimited_download = "";
	   }
	   
	   
	   
	   
	   
	   
	   
	   
	    $zipfile = Input::file('main_file'); 
		if(isset($zipfile))
		 { 
		 $filename = time() . '12.' . $zipfile->getClientOriginalName();
		 $zipformat = base_path('images/media/'); 
		 $zipfile->move($zipformat,$filename); 
		 $zipname = $filename; 
		 }
		 else
		 {
		    $zipname = "";
		 }
		 
		 
		 
		 
		  $videofile = Input::file('video_file'); 
		 if(isset($videofile))
		 { 
		 $filenamme = time() . '172.' . $videofile->getClientOriginalName();
		
		 $videoformat = base_path('images/media/'); 
		 $videofile->move($videoformat,$filenamme); 
		 $videoname = $filenamme; 
		 }
		 else
		 {
		    $videoname = "";
		 }
		 
		 
		 
	   
	   
	   $image = Input::file('preview_image');
		if($image!="")
		{	
		$userphoto="/media/";
		
		$filename  = time() . '24.' . $image->getClientOriginalExtension();
		
		$path = base_path('images'.$userphoto);
		Input::file('preview_image')->move($path, $filename);
		$savefname=$filename;
		}
		else
		{
		$savefname="";
		}
		
		
		
		
		
		$thumbnail = Input::file('item_thumbnail');
		if($thumbnail!="")
		{	
		$userphoto="/media/";
		
		$fileename  = time() . '78.' . $thumbnail->getClientOriginalExtension();
		
		$patth = base_path('images'.$userphoto);
		Input::file('item_thumbnail')->move($patth, $fileename);
		$save_thumb=$fileename;
		}
		else
		{
		$save_thumb="";
		}
	   
	   
	   
	   
	   if(!empty($data['item_tags']))
	   {
	     $item_tags = $data['item_tags'];
	   }
	   else
	   {
	     $item_tags = "";
	   }
	   
	   
	   
	   
	   if($settings[0]->with_submit_product==1)
	   {
	     $status_approval = 0;
		 $submit_msg = $this->call_translate( 1036, $lang);
		 
	   }
	   else
	   {
	     $status_approval = 1;
		 $submit_msg = $this->call_translate( 1039, $lang);
	   }
	   
	   $update_date = date("Y-m-d");
	   
	   
	   
	   
	   
	   
	   $check_sett_seo = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
		if(!empty($check_sett_seo))
		{
		   
		    $sett_meta_seo = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->get();
			$site_seo = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_seo = "";
			}	
		}
		else
		{
		  $site_seo = "";
		}
	   
	   
	   
	   if($site_seo == "no")
	   {
	      $pther = str_replace(" ","-",$item_slug);
	   }
	   else
	   {
	      $pther = $this->clean($item_slug);
	   }
	   
	   
	   
	   
	   
	   foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$item_title[$index];
		   $pagedesc=$item_desc[$index];
		   
		
			if($code=='en')
			   {
				   $parent=0;
			   }
			   else
			   {
			   
			       $product = DB::table('products')
		           	->where('token', '=', $token)
					->where('parent', '=', 0)
					->get();
					
					 $product_cnt = DB::table('products')
		           		->where('token', '=', $token)
					->where('parent', '=', 0)
					->count();
					if($product_cnt==0)
					{
					
                       	$parent = $idd;				
					  
					   
					}
					else
					{
					   $parent=$product[0]->item_id;
					}
					
					
			   }
		
		if(!empty($pagename))
		{
		   $pagenamo = $pagename;
		}
		else
		{
		   $pagenamo = "";
		}
		
		if(!empty($pagedesc))
		{
		   $pagedeo = $pagedesc;
		}
		else
		{
		   $pagedeo = "";
		}
		
		
		
		
		$idd = DB::table('products')-> insertGetId(array(
		
		'item_token' => $token,
		'user_id' => $userid,
		'item_title' => $pagenamo,
        'item_slug' => $pther,
		'item_desc' => htmlentities($pagedeo),
		'regular_price_six_month' => $regular_price_six_month,
		'regular_price_one_year' => $regular_price_one_year,
		'extended_price_six_month' => $extended_price_six_month,
		'extended_price_one_year' => $extended_price_one_year,
		'high_resolution' => $high_resolution,
		'compatible_browser' => $compatiblebrowser,
		'file_included' => $file_included,
		'demo_url' => $demo_url,
		'support_item' => $support_item,
		'future_update' => $future_update,
		'unlimited_download' => $unlimited_download,
		'category' => $categoryid,
		'framework_category' => $frameworkid,
		'first_update' => $update_date,
		'last_update' => $update_date,
		'preview_image' => $savefname,
		'item_thumbnail' => $save_thumb,
		'main_file' => $zipname,
		'item_tags' => $item_tags,
		'item_status' => $status_approval,
		'lang_code' => $code,
		'token' => $token,
		'parent' => $parent,
		
			));
	   
	  } 
		
	   
	   
	 }  
	   
	   
	   
	   
	  
	  
	  
	  $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$picture = time().'_12'.$filename;
					$destinationPath = base_path('images/media/');
					$file->move($destinationPath, $picture);
					
					
					DB::insert('insert into product_images (item_token,image) values (?, ?)', [$token,$picture]);
					
				}
			}
			
			
			
			
			if($videofile!="")
		{
		
		   $check_item_meta =  DB::table('products_meta')
		        				->where('item_token', '=' , $token)
				                ->where('user_id', '=' , $userid)
								->where('item_meta_key', '=' , 'item_video_preview')
		                        ->count();
			if(!empty($check_item_meta))
			{
			   DB::update('update products_meta set item_meta_value="'.$videoname.'" where item_meta_key="item_video_preview" and user_id="'.$userid.'" and item_token = ?', [$token]);
			}
			else
			{
			DB::insert('insert into products_meta (item_token,user_id,item_meta_key,item_meta_value) values (?, ?, ?, ?)', [$token,$userid,'item_video_preview',$videoname]);
			
			}					
		
		  
		}
		
		
		
		
		if($item_type!="")
		{
		
		   $item_type_meta =  DB::table('products_meta')
		        				->where('item_token', '=' , $token)
				                ->where('user_id', '=' , $userid)
								->where('item_meta_key', '=' , 'item_type')
		                        ->count();
			if(!empty($item_type_meta))
			{
			   DB::update('update products_meta set item_meta_value="'.$item_type.'" where item_meta_key="item_type" and user_id="'.$userid.'" and item_token = ?', [$token]);
			}
			else
			{
			DB::insert('insert into products_meta (item_token,user_id,item_meta_key,item_meta_value) values (?, ?, ?, ?)', [$token,$userid,'item_type',$item_type]);
			
			}					
		
		  
		}
		
		
		
	  
	  
	   
	  
	   return back()->with('success', $submit_msg);
	   
	}   
	
	
	
	
	
	
	
	
	public function avigher_delete_photo($delete,$id,$photo) 
	{
	   $orginalfile1 = base64_decode($photo);
	   $userphoto1="/media/";
       $path1 = base_path('images'.$userphoto1.$orginalfile1);
	   File::delete($path1);
	   DB::delete('delete from product_images where item_img_id = ?',[$id]);
	   return back();
	
	}
	
	
	
	public function free_item($id)
	{
	
	  $default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	   $token = base64_decode($id);
	   $url = URL::to("/");
	   
	   $product_details = DB::table('products')->where('item_token','=',$token)->get();
	   
	   $item_meta_well = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
				
		if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('products_meta')
		        ->where('item_token', '=' , $token)
				->where('item_meta_key', '=' , "item_type")
		        
				->get();
			$free_status = $item_meta[0]->item_meta_value;
			
			 if($free_status == "yes")
			 {
			    
				return redirect($url.'/local/images/media/'.$product_details[0]->main_file);
				
			 }
			 else
			 {
			    return back()->with('error', $this->call_translate( 1042, $lang));
			 }
			
			
			}
			else
			{
			  return back()->with('error', $this->call_translate( 1042, $lang));
			}		
				
				
	   
	   
	
	}
	
	
	
	
	public function avigher_edit_items(Request $request)
	{
	
	$default = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('avig_language')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
	
	$userid = Auth::user()->id;
	
	/*$category = DB::table('category')
		            ->where('delete_status','=','')
					->where('status','=',1)
					->orderBy('cat_name', 'asc')->get();*/
			
	
	
		
		
	
	
	   $data = $request->all();
	   
	   
	   
	   
	   
	   $settings = DB::select('select * from settings where id = ?',[1]);
	      $imgsize = $settings[0]->image_size;
		 $zipsize = $settings[0]->zip_size;
		 $imgtype = $settings[0]->image_type;
		
		$rules = array(
		
		
		'main_file' => 'max:'.$zipsize.'|mimes:zip',
		'preview_image' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'item_thumbnail' => 'max:'.$imgsize.'|mimes:'.$imgtype,
		'image.*' => 'image|mimes:'.$imgtype.'|max:'.$imgsize
		
		
		
		);
		
		
		$messages = array(
            
            'preview_image' => 'The :attribute field must only be image'
			
        );

		$validator = Validator::make(Input::all(), $rules, $messages);
		
		
		 
		 
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			return back()->withErrors($validator);
		}
		else
		{
	   
	   if(!empty($data['item_title']))
	   {
	   $item_title = $data['item_title'];
	   }
	   else
	   {
	   $item_title = "";
	   }
	   
	   $item_slug = $data['item_slug'];
	   
	   $item_type = $data['item_type'];
	   
	   
	   if(!empty($data['item_category']))
	   {
		   $cat_id = $data['item_category'];
		   $category_id = "";
		   foreach($cat_id as $category)
		   {
			  $category_id .= $category.',';
		   }
		   
		   $categoryid = rtrim($category_id, ",");
	   }
	   else
	   {
	      $categoryid = "";
	   }
	   
	   
	   if(!empty($data['item_framework']))
	   {
		   $cat_id = $data['item_framework'];
		   $framework_id = "";
		   foreach($cat_id as $category)
		   {
			  $framework_id .= $category.',';
		   }
		   
		   $frameworkid = rtrim($framework_id, ",");
	   }
	   else
	   {
	      $frameworkid = "";
	   }
	   
	   
	   
	   
	   
	   
	   if(!empty($data['item_desc']))
	   {
	   $item_desc = $data['item_desc'];
	   }
	   else
	   {
	   $item_desc = "";
	   }
	  
	   if(!empty($data['regular_price_six_month']))
	   {
	  
	   $regular_price_six_month = $data['regular_price_six_month'];
	   
	   }
	   else
	   {
	     $regular_price_six_month = 0;
	   }
	   
	   
	   
	   if(!empty($data['regular_price_one_year']))
	   {
	   $regular_price_one_year = $data['regular_price_one_year'];
	   }
	   else
	   {
	   $regular_price_one_year = 0;
	   }
	   
	   if(!empty($data['extended_price_six_month']))
	   {
	   $extended_price_six_month = $data['extended_price_six_month'];
	   }
	   else
	   {
	   $extended_price_six_month = 0;
	   }
	   
	   if(!empty($data['extended_price_one_year']))
	   {
	   $extended_price_one_year = $data['extended_price_one_year'];
	   }
	   else
	   {
	     $extended_price_one_year = 0;
	   }
	   
	   
	   
	   /*$regular_price_one_year = $data['regular_price_one_year'];
	   $extended_price_six_month = $data['extended_price_six_month'];
	   $extended_price_one_year = $data['extended_price_one_year'];*/
	   
	   $high_resolution = $data['high_resolution'];
	   
	   $compatible_browser = "";
	   foreach($data['compatible_browser'] as $compatible)
	   {
	   
	      $compatible_browser .= $compatible.',';
	   
	   }
	   $compatiblebrowser = rtrim($compatible_browser,',');
	   
	   $file_included = $data['file_included'];
	   
	   
	   
	   $token = $data['item_token'];
	   
	   
	   if(!empty($data['demo_url']))
	   {
	   $demo_url = $data['demo_url'];
	   }
	   else
	   {
	   $demo_url = "";
	   }
	   
	   
	   
	   $support_item = $data['support_item'];
	  
	   
	   
	   $future_update = $data['future_update'];
	   
	   
	   
	   if(!empty($data['unlimited_download']))
	   {
	   
	   $unlimited_download = $data['unlimited_download'];
	   
	   }
	   else
	   {
	    $unlimited_download = "";
	   }
	   
	   
	   
	   
	   
	   
	   
	   
	    $zipfile = Input::file('main_file'); 
		 if(isset($zipfile))
		 { 
		 $filename = time() . '12.' . $zipfile->getClientOriginalName();
		
		 $zipformat = base_path('images/media/'); 
		 $zipfile->move($zipformat,$filename); 
		 $zipname = $filename;
		 
		 
		 
		 
			 $check_user_meta = DB::table('users_meta')
					->where('user_id', '=' , $userid)
					->where('user_meta_key', '=' , "buyers_update_approval")
					
					->count();
			if(!empty($check_user_meta))
			{
			   
				$user_meta_well = DB::table('users_meta')
					->where('user_id', '=' , $userid)
					->where('user_meta_key', '=' , "buyers_update_approval")
					
					->count();
					
				if(!empty($user_meta_well))
				{	
			   $user_meta = DB::table('users_meta')
					->where('user_id', '=' , $userid)
					->where('user_meta_key', '=' , "buyers_update_approval")
					
					->get();
				$profile_status = $user_meta[0]->user_meta_value;
				}
				else
				{
				$profile_status = "";
				}	
			}
			else
			{
			  $profile_status = "";
			}
			
		 
		 if($profile_status == "yes")
		 {
		 
		     $sale_count = DB::table('product_orders')
							->where('item_token', '=', $token)
							->where('approval_status', '=', 'payment released to vendor')
							->groupBy('user_id')
							->count();
				if(!empty($sale_count))
				{
				   $view_record = DB::table('product_orders')
									->where('item_token', '=', $token)
									->where('approval_status', '=', 'payment released to vendor')
									->groupBy('user_id')
									->get();
						$userid_record = $view_record[0]->user_id;
						
						$userinfo = DB::table('users')
							            ->where('id', '=', $userid_record)
										->count();
						if(!empty($userinfo))
						{
						
						     $view_info = DB::table('users')
							            ->where('id', '=', $userid_record)
										->get();
						     foreach($view_info as $info)
							 {
							     
								 $email_info = $info->email;
								 $name_info = $info->name;
								 
								 
								 $admin_idd=1;
		
								$admin_email = DB::table('users')
										->where('id', '=', $admin_idd)
										->get();
								$item_details = DB::table('products')
										->where('item_token', '=', $token)
										->get();
								$item_id_value = $item_details[0]->item_id;
								$item_slug_value = $item_details[0]->item_slug;				
										
										
								
								$url = URL::to("/");
								
								$site_logo=$url.'/local/images/media/'.$settings[0]->site_logo;
								
								$site_name = $settings[0]->site_name;
								
								$adminemail = $admin_email[0]->email;
								
								$adminname = $admin_email[0]->name;
								
								$datas = [
									'name_info' => $name_info, 'email_info' => $email_info, 'site_logo' => $site_logo,
									'site_name' => $site_name, 'url' => $url, 'item_id_value' => $item_id_value, 'item_slug_value' => $item_slug_value
								];
								
								
								
								$check_sett_sname = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		
								
								Mail::send('update_mail', $datas , function ($message) use ($adminemail,$adminname,$email_info,$sett_sender_name,$sett_sender_email,$lang)
								{
								
								
								
								
									$message->subject($this->call_translate( 1045, $lang));
									
									$message->from($sett_sender_email, $sett_sender_name);
						
									$message->to($email_info);
						
								}); 
								
						
								 
								 
								 
								 
								 
								 
							 }
						
						}				
						
						
									
				}			
		 
		 
		 }
		 
		 
		 
		 
		  
		 }
		 else
		 {
		    $zipname = $data['current_file'];
			
			
		 }
		 
		 
		 
		 
		 
		 
		 $videofile = Input::file('video_file'); 
		 if(isset($videofile))
		 { 
		 $filenamme = time() . '172.' . $videofile->getClientOriginalName();
		
		 $videoformat = base_path('images/media/'); 
		 $videofile->move($videoformat,$filenamme); 
		 $videoname = $filenamme; 
		 }
		 else
		 {
		    if(!empty($data['current_video']))
			{
		    $videoname = $data['current_video'];
			}
			else
			{
			$videoname = "";
			}
		 }
		 
		 
		 
		 
		 
		 $thumbnail = Input::file('item_thumbnail');
		if($thumbnail!="")
		{	
		$userphoto="/media/";
		
		$fileename  = time() . '78.' . $thumbnail->getClientOriginalExtension();
		
		$patth = base_path('images'.$userphoto);
		Input::file('item_thumbnail')->move($patth, $fileename);
		$save_thumb=$fileename;
		}
		else
		{
		$save_thumb=$data['current_thumb'];
		}
		 
		 
		 
	   
	   
	   $image = Input::file('preview_image');
		if($image!="")
		{	
		$userphoto="/media/";
		
		$filename  = time() . '30.' . $image->getClientOriginalExtension();
		
		$path = base_path('images'.$userphoto);
		Input::file('preview_image')->move($path, $filename);
		$savefname=$filename;
		}
		else
		{
		$savefname=$data['current_preview'];
		}
	   
	   
	   
	   
	   if(!empty($data['item_tags']))
	   {
	     $item_tags = $data['item_tags'];
	   }
	   else
	   {
	     $item_tags = "";
	   }
	   
	   
	   
	   
	   if($settings[0]->with_submit_product==1)
	   {
	     $status_approval = 0;
		 $submit_msg = $this->call_translate( 1048, $lang);
		 
	   }
	   else
	   {
	     $status_approval = 1;
		 $submit_msg = $this->call_translate( 1051, $lang);
	   }
	   
	   $update_date = date("Y-m-d");
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   $check_sett_seo = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
		if(!empty($check_sett_seo))
		{
		   
		    $sett_meta_seo = DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_meta')
		        ->where('sett_meta_id', '=' , 21)
				->where('sett_meta_key', '=' , "site_seo_slug")
		        
				->get();
			$site_seo = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_seo = "";
			}	
		}
		else
		{
		  $site_seo = "";
		}
	   
	   
	   
	   if($site_seo == "no")
	   {
	      $pther = str_replace(" ","-",$item_slug);
	   }
	   else
	   {
	      $pther = $this->clean($item_slug);
	   }
	   
	 $item_id = $data['item_id'];
	 
	 
	 foreach($data['code'] as $index => $code)
		{
		
		   $pagename=$item_title[$index];
		   $pagedesc=$item_desc[$index];		
		   	
		   if($code=="en")
			{
			  
			  
			  
			 
			  
			  
			  DB::update('update products set item_title="'.$pagename.'",item_slug="'.$pther.'",item_desc="'.htmlentities($pagedesc).'",regular_price_six_month="'.$regular_price_six_month.'",regular_price_one_year="'.$regular_price_one_year.'",extended_price_six_month="'.$extended_price_six_month.'",extended_price_one_year="'.$extended_price_one_year.'",high_resolution="'.$high_resolution.'",compatible_browser="'.$compatiblebrowser.'",file_included="'.$file_included.'",demo_url="'.$demo_url.'",support_item="'.$support_item.'",future_update="'.$future_update.'",unlimited_download="'.$unlimited_download.'",category="'.$categoryid.'", framework_category="'.$frameworkid.'",last_update="'.$update_date.'" ,item_thumbnail="'.$save_thumb.'",preview_image="'.$savefname.'",main_file="'.$zipname.'",item_tags="'.$item_tags.'",item_status="'.$status_approval.'",lang_code="'.$code.'",item_token="'.$token.'" where item_id = ?', [$item_id]);	
			  
			}
			else
			{
			    $counts = DB::table('products')
		            ->where('lang_code', '=', $code)
					 ->where('parent', '=', $item_id)
					  ->count();
			     if($counts==0)
				 {
						if(!empty($pagename))
						{
						   $pagenamo = $pagename;
						   $pagedeso = $pagedesc;
						}
						else
						{
						   $pagenamo = "";
						   $pagedeso = "";
						}
						
						
						
						
				     DB::insert('insert into products (user_id,item_title,item_slug,item_desc,regular_price_six_month, regular_price_one_year,extended_price_six_month,extended_price_one_year,high_resolution,compatible_browser, file_included,demo_url,support_item,future_update,unlimited_download,category,framework_category,last_update,preview_image, 
item_thumbnail,main_file,item_tags,item_status,lang_code,
item_token,parent) values (?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?, ?,?,?,?,?,?)', [$userid,$pagenamo,$pther,htmlentities($pagedeso),$regular_price_six_month,  $regular_price_one_year,$extended_price_six_month,$extended_price_one_year,$high_resolution,$compatiblebrowser,  $file_included,$demo_url,$support_item,$future_update,$unlimited_download,  $categoryid,$frameworkid,$update_date,$savefname,$save_thumb,$zipname,$item_tags,$status_approval,$code,$token,$item_id]);
					 
			
			
					 
				 }
				 else
				 {
				   
				   
				   DB::update('update products set item_title="'.$pagename.'",item_slug="'.$pther.'",item_desc="'.htmlentities($pagedesc).'",regular_price_six_month="'.$regular_price_six_month.'",regular_price_one_year="'.$regular_price_one_year.'",extended_price_six_month="'.$extended_price_six_month.'",extended_price_one_year="'.$extended_price_one_year.'",high_resolution="'.$high_resolution.'",compatible_browser="'.$compatiblebrowser.'",file_included="'.$file_included.'",demo_url="'.$demo_url.'",support_item="'.$support_item.'",future_update="'.$future_update.'",unlimited_download="'.$unlimited_download.'",category="'.$categoryid.'", framework_category="'.$frameworkid.'",last_update="'.$update_date.'" ,item_thumbnail="'.$save_thumb.'",preview_image="'.$savefname.'",main_file="'.$zipname.'",item_tags="'.$item_tags.'",item_status="'.$status_approval.'",item_token="'.$token.'" where lang_code="'.$code.'" and parent = ?', [$item_id]);	
				   
				   
				  
				   
				   
				 }
			
			}
		}
		
	   	
			
		
			
			
			
			
	   
	  } 
	  
	  
	  
	  $picture = '';
			if ($request->hasFile('image')) {
				$files = $request->file('image');
				foreach($files as $file){
					
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					$picture = time().'65'.$filename;
					$destinationPath = base_path('images/media/');
					$file->move($destinationPath, $picture);
					
					
					DB::insert('insert into product_images (item_token,image) values (?, ?)', [$token,$picture]);
					
				}
			}
			
			
			 $userridd = Auth::user()->id;
			
		if($item_type!="")
		{
		
		   $check_item_key =  DB::table('products_meta')
		        				->where('item_token', '=' , $token)
				                ->where('user_id', '=' , $userridd)
								->where('item_meta_key', '=' , 'item_type')
		                        ->count();
			if(!empty($check_item_key))
			{
			   DB::update('update products_meta set item_meta_value="'.$item_type.'" where item_meta_key="item_type" and user_id="'.$userridd.'" and item_token = ?', [$token]);
			}
			else
			{
			DB::insert('insert into products_meta (item_token,user_id,item_meta_key,item_meta_value) values (?, ?, ?, ?)', [$token,$userridd,'item_type',$item_type]);
			
			}					
		
		  
		}	
		
		
		
		
		if($videofile!="")
		{
		
		   $check_item_meta =  DB::table('products_meta')
		        				->where('item_token', '=' , $token)
				                ->where('user_id', '=' , $userridd)
								->where('item_meta_key', '=' , 'item_video_preview')
		                        ->count();
			if(!empty($check_item_meta))
			{
			   DB::update('update products_meta set item_meta_value="'.$videoname.'" where item_meta_key="item_video_preview" and user_id="'.$userridd.'" and item_token = ?', [$token]);
			}
			else
			{
			DB::insert('insert into products_meta (item_token,user_id,item_meta_key,item_meta_value) values (?, ?, ?, ?)', [$token,$userridd,'item_video_preview',$videoname]);
			
			}					
		
		  
		}
			
			
	   
	  
	   return back()->with('success', $submit_msg);
	   
	}   
	
	
	
	
	
	
	
	
	 
	
	
}
