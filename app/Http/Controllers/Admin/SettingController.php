<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // seo page show method
    public function seo(){
        $data = DB::table('seos')->first();
        return view('admin.settings.seo',compact('data'));
    }

    // seo update method
    public function seoUpdate(Request $request, $id){
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_keyword'] = $request->meta_keyword;
        $data['meta_description'] = $request->meta_description;
        $data['google_verification'] = $request->google_verification;
        $data['alexa_verification'] = $request->alexa_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['google_adsense'] = $request->google_adsense;

        DB::table('seos')->where('id',$id)->update($data);

        $notification = array('message' => 'Seo Setting Updated!','alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    // Smtp Method

    public function smtp(){
        $smtp = DB::table('smtp')->first();
        return view('admin.settings.smtp',compact('smtp'));
    }

    // Smtp Update Method
    public function smtpUpdate(Request $request, $id){
        $smtp = array();
        $smtp['mailer']= $request->mailer;
        $smtp['host']= $request->host;
        $smtp['port']= $request->port;
        $smtp['user_name']= $request->user_name;
        $smtp['password']= $request->password;

        DB::table('smtp')->where('id',$id)->update($smtp);

        $notification = array('message' => 'SMTP Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Website Setting Method
    public function website(){
        $setting = DB::table('settings')->first();

        return view('admin.settings.website_setting',compact('setting'));
    }

    // Website Upload Method
    public function websiteUpdate(Request $request, $id){
        $data = array();
        $data['currency'] = $request->currency;
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['main_email'] = $request->main_email;
        $data['support_email'] = $request->support_email;
        $data['address'] = $request->address;
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;
        $data['linkedin'] = $request->linkedin;
        $data['youtube'] = $request->youtube;

        if($request->logo){
            $logo = $request->logo;
            $logo_name = uniqid().'.'.$logo->getClientOriginalExtension();
            Image::make($logo)->resize(320,120)->save('public/files/setting/'.$logo_name);
            $data['logo'] = 'public/files/setting/'.$logo_name;
        }else{
            $data['logo'] = $request->old_logo;
        }

        if($request->favicon){
            $favicon = $request->favicon;
            $favicon_name = uniqid().'.'.$favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32,32)->save('public/files/setting/'.$favicon_name);
            $data['favicon'] = 'public/files/setting/'.$favicon_name;
        }else{
            $data['favicon'] = $request->old_favicon;
        }

        DB::table('settings')->where('id',$id)->update($data);
        $notification = array('message' => 'Website Setting Updated!', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }


    // Payment Gateway
    public function PaymentGateway(){
        $aamerPay = DB::table('payment_gateway_bd')->first();
        $surjoPay = DB::table('payment_gateway_bd')->skip(1)->first();
        $ssl = DB::table('payment_gateway_bd')->skip(2)->first();

        return view('admin.bd_payment_gateway.edit',compact('aamerPay','surjoPay','ssl'));
    }

    public function UpdateAamerpay(Request $request){
        $data = array();
        $data['store_id'] = $request->store_id;
        $data['signature_key'] = $request->signature_key;
        $data['status'] = $request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification = array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function UpdateSurjopay(Request $request){
        $data = array();
        $data['store_id'] = $request->store_id;
        $data['signature_key'] = $request->signature_key;
        $data['status'] = $request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification = array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
    public function UpdateSsl(Request $request){
        $data = array();
        $data['store_id'] = $request->store_id;
        $data['signature_key'] = $request->signature_key;
        $data['status'] = $request->status;
        DB::table('payment_gateway_bd')->where('id',$request->id)->update($data);
        $notification = array('message' => 'Payment Gateway Updated!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
