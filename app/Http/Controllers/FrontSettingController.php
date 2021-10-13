<?php

namespace App\Http\Controllers;

use App\Models\FooterMenu;
use App\Models\LicenseFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Validator;

class FrontSettingController extends Controller
{
    // public function FrontSetting(){
    //     $data = FrontSetting::where('active_status', 1)->first();
    //     return view('backend.frontSetting.front-setting',compact('data'));
    // }
    // public function FrontSettingEdit(){
    //     $editData = FrontSetting::where('active_status', 1)->first();
    //     return view('backend.frontSetting.update-front-setting',compact('editData'));
    // }

    // public function FrontSettingUpdate(Request $request)
    // {

        
    //     $request->validate([
    //         'category_limit' => 'required',
    //         'color1' => 'required',
    //         'color2' => 'required',
    //         'color3' => 'required',
    //     ]);

    //     $s = FrontSetting::find($request->id);
    //     $s->category_limit = $request->category_limit;
    //     $s->color1 = $request->color1;
    //     $s->color2 = $request->color2;
    //     $s->color3 = $request->color3;
    //     $results = $s->save();
    //     if ($results) {
    //         Toastr::success('Operation Success', 'Success');
    //         return redirect('front-setting');
    //     } else {
    //         Toastr::error('Something went wrong ! try again ', 'Success');
    //         return redirect()->back();
    //     }
    // }




    // Footer Menu
    public function FooterMenu()
    {
        try{
            $data = FooterMenu::where('active_status', 1)->orderBy('position_no', 'ASC')->get(); 
            return view('backend.footer_menu.footer_menu', compact('data'));
        }catch (Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back(); 
        }
    } 
    public function FooterMenuEdit($id)
    {
        
        try{
            $editData = FooterMenu::find($id); 
            $data = FooterMenu::where('active_status', 1)->orderBy('position_no', 'ASC')->get();
            return view('backend.footer_menu.footer_menu', compact('editData','data'));
        }catch (Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back(); 
        }
    } 
    public function updateFooterMenu(Request $request){

        $validator = Validator::make($request->all(), [
            'menu_title' => 'required|max:150',
            'menu_url' => 'required|max:250',
            'position_no' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        try{
            $new_position=FooterMenu::find($request->id);
            $old_position=$new_position->position_no;
            $current_position=FooterMenu::where('position_no',$request->position_no)->first();
    
            $store = FooterMenu::find($request->id);
            $store->position_no = null;
            $store->save();
    
            $current_position->position_no=$old_position;
            $current_position->save();
    
            $Footer_Menu = FooterMenu::find($request->id);
            $Footer_Menu->menu_title=$request->menu_title;
            $Footer_Menu->menu_url=$request->menu_url;
            $Footer_Menu->position_no= $request->position_no;
            $Footer_Menu->save();
            
            Toastr::success('Operation successful', 'Success');
            return redirect('footer-menu');
        }catch (Exception $e) {
           Toastr::error('Operation Failed', 'Failed');
           return redirect()->back(); 
        }
    }

    // License Feature
    // public function licenseFeature()
    // {
    //     try{ 
    //         $data = LicenseFeature::where('active_status', 1)->get(); 
    //         return view('backend.license.license_feature', compact('data'));
    //     }catch(Exception $e){ 
    //         Toastr::error('Operation Failed', 'Failed');
    //         return redirect()->back(); 
    //     }
    // } 

    public function licenseFeatureStore(Request $request){
     
        $validator = Validator::make($request->all(), [
            'feature_title' => 'required|max:250',
            'regular' => 'required',
            'extended' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back() ->withErrors($validator) ->withInput();
        }
        try{ 
            $feature = new  LicenseFeature();
            $feature->feature_title=$request->feature_title;
            $feature->regular=$request->regular;
            $feature->extended=$request->extended;
            $feature->save(); 
            Toastr::success('Operation successful', 'Success');
            return redirect(('pages/license'));
        }catch(Exception $e){ 
            Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back(); 
        }

    }
    public function licenseFeatureEdit($id)
    {
        try{ 
            $editData = LicenseFeature::find($id); 
            // return $editData;
            $data = LicenseFeature::where('active_status', 1)->get();
            return view('backend.license.license_feature', compact('editData','data'));
        }catch(Exception $e){ 
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back(); 
        }
    } 
    public function licenseFeatureUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'feature_title' => 'required|max:250',
            'regular' => 'required',
            'extended' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        try{ 
            $feature = LicenseFeature::find($request->id);
            $feature->feature_title=$request->feature_title;
            $feature->regular=$request->regular;
            $feature->extended=$request->extended;
            $feature->save();
            
            Toastr::success('Operation successful', 'Success');
            return redirect('pages/license');
        }catch(Exception $e){ 
            // Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back(); 
        }
    }
    public function licenseFeatureDelete($id){
        try{ 
            $feature = LicenseFeature::findOrfail($id);
            $feature->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect('pages/license');
        }catch(Exception $e){ 
            // Log::info($e->getMessage());
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back(); 
        }
    }
}