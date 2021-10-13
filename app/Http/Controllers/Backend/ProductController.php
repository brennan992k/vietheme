<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\Review;
use ZipArchive;
use App\Models\Comment;
use App\Models\ItemFee;
use App\Models\BuyerFee;
use App\Models\Feedback;
use App\Models\Attribute;
use App\Models\ItemImage;
use App\Models\TableList;
use Carbon\Carbon;
use App\Models\ItemPreview;
use App\Models\SessionFile;
use App\Models\ItemCategory;
use App\Models\SubAttribute;
use App\Models\ItemAttribute;
use App\Models\ItemSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Modules\Systemsetting\Entities\InfixEmailSetting;

class ProductController extends Controller
{
    
    /* ********************* START  CATEGORY *************************  */
    public function adCategory()
    {
        try{
            $data['category'] = ItemCategory::all(); 
            return view('backend.product.adCategory', compact('data'));
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
    } 

    public function adCategoryStore(Request $request)
    {
        $request->validate([
            'title' => "required|string|unique:item_categories,title",
            'file_permission' => "required",
            'up_permission' => "required",
            'recommended_price' => "required",
            'recommended_price_extended' => "required",
            'recommended_price_commercial' => "required",
        ]);
      
        try{
            $new_category_position=ItemCategory::max('position')+1;
            $store = new ItemCategory();
            $store->title = $request->title;
            $store->slug = strtolower(str_replace(' ', '_',$request->title));
            $store->up_permission = $request->up_permission;
            $store->file_permission = $request->file_permission;
            $store->description = $request->description;
            $store->active_status = 1;
            $store->position = $new_category_position;
            $store->recommended_price = $request->recommended_price;
            $store->recommended_price_extended = $request->recommended_price_extended;
            $store->recommended_price_commercial = $request->recommended_price_commercial;
            $store->show_menu = isset($request->show_menu) ? 1 : 0;
            $result = $store->save();
    
            if ($result) {
                Toastr::success('Succsesfuly Category Added !','Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed','Error');
                return redirect()->back();
            }
        }catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function editCategory($id)
    {
        try{
            $data['category'] = ItemCategory::all();
            $data['edit'] = ItemCategory::find($id);
            return view('backend.product.adCategory', compact('data'));
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
    }

    
    public function updateCategory(Request $request)
    {
        $request->validate([
            'title' => "required|string|unique:item_categories,title,".$request->id,
            'file_permission' => "required",
            'up_permission' => "required",
            'active_status' => "required",
            'recommended_price' => "required",
            'recommended_price_extended' => "required",
            'recommended_price_commercial' => "required",
        ]);
        try{
            $new_category=ItemCategory::find($request->id);
            $old_position=$new_category->position;
            $current_category=ItemCategory::where('position',$request->position)->first();
            if ($current_category!='') {
                $store = ItemCategory::find($request->id);
                $store->position = null;
                $result = $store->save();

                $current_category->position=$old_position;
                $current_category->save();
    
                $store = ItemCategory::find($request->id);
                $store->title = $request->title;
                $store->slug = strtolower(str_replace(' ', '_',$request->title));
                $store->up_permission = $request->up_permission;
                $store->file_permission = $request->file_permission;
                $store->recommended_price = $request->recommended_price;
                $store->recommended_price_extended = $request->recommended_price_extended;
                $store->recommended_price_commercial = $request->recommended_price_commercial;
                $store->description = $request->description;
                $store->show_menu = isset($request->show_menu) ? 1 : 0;
                $store->active_status = $request->active_status;
                if ($request->active_status==2) {
                    $store->position = null;
                }else{
                    $store->position = $request->position;
                }
                $result = $store->save();
    
            } else {
                $store = ItemCategory::find($request->id);
                $store->title = $request->title;
                $store->slug = strtolower(str_replace(' ', '_',$request->title));
                $store->up_permission = $request->up_permission;
                $store->file_permission = $request->file_permission;
                $store->recommended_price = $request->recommended_price;
                $store->recommended_price_extended = $request->recommended_price_extended;
                $store->recommended_price_commercial = $request->recommended_price_commercial;
                $store->description = $request->description;
                $store->active_status = $request->active_status;
                $store->show_menu = isset($request->show_menu) ? 1 : 0;
                if ($request->active_status==2) {
                    $store->position = null;
                }else{
                    $store->position = $request->position;
                }
                $result = $store->save();
            }
            
            if ($result) {
                Toastr::success('Succsesfully Category updated !','Success');
                return redirect()->route('admin.adCategory');
            } else {
                Toastr::error('Something went wrong ! try again ','Success');
                return redirect()->back();
            }
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
    }

   public function deleteCategory(Request $request, $id)
    {
        $tables = TableList::getTableList('category_id', $id);
        $tables= str_replace('Infix category question,','',$tables);
        // dd($tables);
        try {
            if ($tables == null|| $tables == ' ') {

                $delete_query=ItemCategory::find($id);
                $delete_query->delete();

                    Toastr::success('Succsesfully Deleted!','Success');
                return redirect()->back();
            } else {
                $msg = 'This data already used in '. $tables.' tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
        
    }
    /* *********************  END CATEGORY  *************************  */


     /* ********************* START SUB CATEGORY *************************  */
     public function subCategory()
     {
        try{
            $data['subCategory'] = ItemSubCategory::all();
            $data['category'] = ItemCategory::all();
            return view('backend.product.subCategory', compact('data'));
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
     }

     function sameCategoryWithTitleExists($category_id, $title){
        $is_exist = ItemSubCategory::where('item_category_id', $category_id)->where('title', $title)->first();
        if($is_exist){
            return TRUE;
        }else{
            return FALSE;
        }
     }

     function UpdateCategoryWithTitleExists($category_id, $title, $id){
        $is_exist = ItemSubCategory::where('item_category_id', $category_id)
        ->where('title', $title)->where('id', '!=', $id)->first();
        if($is_exist){
            return TRUE;
        }else{
            return FALSE;
        }
     }
 
     public function subCategoryStore(Request $request)
     {
        $validator=Validator::make($request->all(), [
            'title' => "required|max:200",
            'category_id' => "required",
            'active_status' => "required",
        ])->validate(); 

        if ($this->sameCategoryWithTitleExists($request->category_id, $request->title)) {
            Toastr::error('The title has already been taken !','Failed');
            return redirect()->back()->withInput(); 
        }


        try{
            $store = new ItemSubCategory();
            $store->title = $request->title;
            $store->slug = strtolower(str_replace(' ', '_',$request->title));
            $store->description = $request->description;
            $store->item_category_id = $request->category_id;
            $store->active_status = $request->active_status;
            $store->show_menu = isset($request->show_menu) ? 1 : 0;
            $result = $store->save();
    
            if ($result) {
               Toastr::success('Succsesfully Sub Category Added !','Success');
                return redirect()->back();
            } else {
               Toastr::error('Something went wrong ! try again ','Success');
                return redirect()->back();
            }
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
     }
     function editSubCategory($id){
        
        try{
            $data['subCategory'] = ItemSubCategory::all();
            $data['category'] = ItemCategory::all();
            $data['edit'] = ItemSubCategory::find($id);
            return view('backend.product.subCategory', compact('data'));  
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
     }

     public function updateSubCategory(Request $request)
     {
         $request->validate([
            'title' => 'required|max:200',
             'category_id' => "required",
             'active_status' => "required",
         ]);
        
         if ($this->UpdateCategoryWithTitleExists($request->category_id, $request->title, $request->id)) {
            Toastr::error('The title has already been taken !','Failed');
            return redirect()->back()->withInput(); 
        }


         try{
            $store = ItemSubCategory::find($request->id);
            $store->title = $request->title;
            $store->slug = strtolower(str_replace(' ', '_',$request->title));
            $store->description = $request->description;
            $store->item_category_id = $request->category_id;
            $store->active_status = $request->active_status;
            $store->show_menu = isset($request->show_menu) ? 1 : 0;
            $result = $store->save();
    
            if ($result) {
                Toastr::success('Succsesfully Sub Category updated !','Success');
                return redirect()->route('admin.subCategory');
            } else {
                Toastr::error('Something went wrong ! try again ','Failed');
                return redirect()->back();
            }
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
 
     }
    //  function deleteSubCategory($id){
        
    //     try{
    //         $data=ItemSubCategory::find($id);
    //         $data->delete();
    //         Toastr::success('Succsesfully Category deleted !','Success');
    //         return redirect()->route('admin.subCategory');
    //     }catch (Exception $e) {
    //        $msg=str_replace("'", " ", $e->getMessage()) ;
    //         Toastr::error($msg, 'Failed');
    //         return redirect()->back(); 
    //     }
    // }

   public function deleteSubCategory(Request $request, $id)
    {
        try {
            $tables = TableList::getTableList('sub_category_id', $id);
            try {
                if ($tables == null) {

                    $delete_query=ItemSubCategory::find($id);
                    $delete_query->delete();

                    Toastr::success('Operation Successfull', 'Success');
                    return redirect()->back();
                } else {
                    $msg = 'This data already used in tables, Please remove those data first';
                    Toastr::error($msg, 'Failed');
                    return redirect()->back();
                }
            } catch (\Illuminate\Database\QueryException $e) {

                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
             $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


     /* *********************  END SUB CATEGORY  *************************  */

     /* *********************  START PRODUCT  *************************  */

     function content(){

        try {
            // $data['item']=Item::where(['active_status'=>1,'status'=> 1,'free'=>0])->orderBy('id','desc')->get();
            $data['item']=DB::table('items')
            ->leftjoin('item_categories','item_categories.id','=','items.category_id')
            ->leftjoin('users','users.id','=','items.user_id')
            ->leftjoin('item_sub_categories','item_sub_categories.id','=','items.sub_category_id')
            ->where('items.active_status',1)
            ->where('items.status',1)
            ->where('items.free',0)
            ->select('items.*','item_categories.title as category_title','item_categories.slug as category_slug',
            'users.username','item_sub_categories.title as sub_category_title','item_sub_categories.slug as sub_category_slug')
            // ->groupBy('items.id')
            ->orderBy('items.id','desc')
            ->get();

            // return $data;
            $data['settings'] = DB::table('infix_general_settings')->first();
            return view('backend.product.content_list', compact('data'));          
          } catch (Exception $e) {
               $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back();
          }
         
     }
     public function product_upload(){
        $data['category'] = ItemCategory::where('up_permission',1)->get();
        $data['subCategory'] = ItemSubCategory::where('active_status',1)->get();
        $data['attribute'] = Attribute::all();
        $data['sub_attribute'] = SubAttribute::latest()->get();

        return view('backend.product.product_upload', compact('data'));

     }
     public function selectCategory(Request $r){
        try {
            $category = ItemCategory::find($r->category);
            Session::put('categorySlect', $category);
            return redirect()->route('admin.product_upload');
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
     }
     function deactiveProduct(){

        try {
            $data['item']=Item::where(['active_status'=>1,'status'=> 0])->orderBy('id','desc')->get();
            return view('backend.product.deactive_product_list', compact('data'));          
          } catch (Exception $e) {
               $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back();
          }
         
     }
     function contentView($id){
         
         try{
            $data['item']=Item::findOrFail($id);
            return view('backend.product.item_review',compact('data'));
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
     }



     function contentEdit($id){
        try {
           

            $item_preview=ItemPreview::where('item_id',$id)->where('status',1)->first();
            // return $item_preview;
            $data['edit']=Item::find($id);
            $data['attributes']= $data['edit']->attribute;
            $data['category'] = ItemCategory::where('up_permission',1)->get();
            $data['subCategory'] = ItemSubCategory::where('active_status',1)->get();
            $data['attribute'] = Attribute::all();
            $data['sub_attribute'] = SubAttribute::latest()->get();
            $category = ItemCategory::where('up_permission',1)->get();
            $attribute = Attribute::all();


            return view('frontend.vendor.editContent', compact('data','category','item_preview'));
            } catch (Exception $e) {
                $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back();
        }
    }

    // admin update product 
public function itemUpdate(Request $r){
           
    // Dynamic attribute validation 
    if(@$r->optional_att){
        $attributes=@$r->optional_att;
        foreach($attributes as $field_name=>$attribute){
            foreach($attribute as $key=>$value){
                if (!is_numeric($value)){
                    $s= Attribute::where('field_name', $field_name )->select('name')->first();
                    if($s){
                        Toastr::error('You have write wrong input for '.@$s->name , 'Failed');
                    }else{
                        Toastr::error('You have write wrong attributes', 'Failed');
                    }
                    return redirect()->back()->withInput();
                }
            }
        }
    }
    // End Dynamic attribute validation

    $r->validate([
        'title' => 'required|string|max:200',
        'feature1' => 'required|string|max:100',
        'feature2' => 'required|string|max:100',
        'description' => 'required|string',
        'thumdnail'=>'sometimes|nullable|required|dimensions:max_width=80,max_height=80',
        'theme_preview' => 'sometimes|nullable|required|',
        'main_file' => 'sometimes|nullable|required|',
        'file' => 'sometimes|nullable|required|',
        'category_id' => 'required|',
        'demo_url' => 'required|url',
        'Re_item' => 'required|',
        'Re_buyer' => 'required|',
        'Reg_total_price' => 'required|',
        'E_item' => 'required|',
        'E_buyer' => 'required|',
        'Ex_total_price' => 'required|',
        'tags' => 'required|string',
    ]);


    DB::beginTransaction();
    try {

        $item_data=Item::find($r->id);
    
        // $item =new ItemPreview();
        $item=Item::find($r->id);
        // $item->item_id = $r->id;
        $item->title = $r->title;
        $item->feature1 = $r->feature1;
        $item->feature2 = $r->feature2;
        $item->description = $r->description;    
        $item->sub_category_id = $r->sub_category_id;
        $item->category_id = $r->category_id;
        //$item->resolution = $r->resolution;
        //$item->widget = $r->widget;
        $item->tags = $r->tags;
        //$item->compatible_browsers = implode(",", $r->compatible_browsers);
        //$item->compatible_with = implode(",", $r->compatible_with);
        //$item->framework = implode(",", $r->framework);
        //$item->software_version = implode(",", $r->software_version);
        $item->Re_item = $r->Re_item;
        $item->Re_buyer = $r->Re_buyer;
        $item->Reg_total = $r->Reg_total_price;
        $item->E_item = $r->E_item;
        $item->E_buyer = $r->E_buyer;
        $item->Ex_total = $r->Ex_total_price;
        // $item->user_msg = $r->user_msg;
        //$item->layout = $r->layout;
        //$item->columns = $r->columns;
        $item->demo_url = $r->demo_url;
        $item->active_status = 1;
        //  return $r;
        if ($r->file('theme_preview')) {
        $zip = new \ZipArchive();
        $file = $r->file('theme_preview');
        $zip->open($file->path());

        $filesInside = [];
                
        for ($i = 0; $i < $zip->count(); $i++) {
            
            $file_name=$zip->getNameIndex($i);
            $exten= substr($file_name, strpos($file_name, ".") + 1);
            if ($exten=='jpg' ||$exten=='jpeg' ||$exten=='png') {
                array_push($filesInside, $zip->getNameIndex($i));
            }
        }



        $theme_preview = "";
        if ($r->file('theme_preview') != "") {
            $file = $r->file('theme_preview');
            $theme_preview = 'theme_p-'. md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('public/uploads/SessionFile/', $theme_preview);
            $theme_preview =  'public/uploads/SessionFile/' . $theme_preview;
        }
        $theme_preview =$theme_preview;
        $dest= 'public/uploads/product/themePreview';


        if ($r->theme_preview && file_exists($theme_preview)) {

            // $product_id=Item::max('id')+1;
            $product_image_path = 'public/uploads/product/themePreview/'.$r->id.'/';                            
            $Image =  time().'-';                         
            if (!file_exists($product_image_path)){
                mkdir($product_image_path, 0777, true);
            }

            // \Zipper::make($theme_preview)->extractTo($product_image_path);
            $zip_extract = new ZipArchive;
            $res = $zip_extract->open($theme_preview);
            if ($res === TRUE) {
                $zip_extract->extractTo($product_image_path);
                $zip_extract->close();
            } else {
                return false;
            }

            $filesInFolder = File::files($product_image_path);  
            $image_list=[]; 
            for ($i = 0; $i < $zip->count(); $i++) {
            
                $file_name=$zip->getNameIndex($i);
                $file_exten=explode('.',$file_name);
                    if ($file_exten[1]=='jpeg' ||$file_exten[1]=='png'||$file_exten[1]=='jpg' ) {
                        $image_list[]=$product_image_path.$file_name ;
                    }
                
            }

        $preview_image_list= implode(',',$image_list);
        //    $item->screen_shot = $preview_image_list;
        $item->theme_preview = $preview_image_list;
        $item->save();
        
        }else{
            return false;
        }

    }else{
    //    $item->screen_shot = $item_data->screen_shot;
    $item->theme_preview = $item_data->theme_preview;
    }
    $thumbnail =$item_data->icon;
    if ($r->file('thumdnail') != "") {
        $file = $r->file('thumdnail');
        $thumbnail = 'thum-'. md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('public/uploads/SessionFile/', $thumbnail);
        $thumbnail =  'public/uploads/SessionFile/' . $thumbnail;
    }
    $item->icon=$thumbnail;
    $item->save();

    $main_file1=$item_data->main_file;
    if ($r->file('main_file') != "") {
        $file = $r->file('main_file');
        $main_file1 = 'theme_p-'. md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('public/uploads/product/main_file/zip/', $main_file1);
        $main_file1 =  'public/uploads/product/main_file/zip/' . $main_file1;
    }

    $item->file = $main_file1;
    $item->save();
    $main_file2=$item_data->main_file;
    if ($r->file('file') != "") {
        $file = $r->file('file');
        $main_file2 = 'theme_p-'. md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $file->move('public/uploads/product/main_file/zip/', $main_file2);
        $main_file2 =  'public/uploads/product/main_file/zip/' . $main_file2;
    }
    $item->file = $main_file2;
    $item->status = 1;
    $item->save();
    if ($r->theme_preview) {
        if ($image_list) {
            $item->thumbnail = $image_list[0];
            $img = new ItemImage();
            $img->item_id = $item->id;
            $img->type='theme_preview';
            $img->image = implode(",",$image_list);    
            $img->save();    
        }
    }
    $item->save();


        Toastr::success('Product updated successfully','Success');

        $data =SessionFile::where('user_id',Auth::user()->id)->get();
            foreach ($data as $key => $value) {
                if ($value->file_name) {
                    File::delete('public/uploads/SessionFile/'.$value->file_name);
                }
                $value->delete();
            }
            


            
        

        if(@$r->optional_att){ 
            $s = ItemAttribute::where('item_id',$item_data->id )->delete();
            $attributes=@$r->optional_att;
            foreach($attributes as $field_name=>$attribute){
                $ItemAttribute =new ItemAttribute();
                $ItemAttribute->item_id = $item_data->id;
                $ItemAttribute->field_name = $field_name;
                $ItemAttribute->values =  json_encode($attribute);
                $ItemAttribute->save();
            }
        }

        
             DB::commit(); 
            return redirect()->back();
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }

}




      function fileValidation($file){
        try {
            if (File::extension(@$file) == 'zip' || File::extension(@$file) == 'ZIP') {
                return $file;
            }      
            else {
                Toastr::error('File type must be : zip','Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
      }

      function itemDelete($id){
        try {
            $item =Item::find($id)->update(['active_status' => 0 ]);
            Toastr::success('Item deleted Successfully','Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
      }
      
     /* *********************  END PRODUCT  *************************  */

     // item active deactive section 

     function Item_approve($id){
         try {
            $data=Item::findOrFail($id);
            if ($data->status==1) {
                $data->status = 0;
                $msg = 'item de-active';
            }else {
                $data->status = 1;
                $msg = 'item active';
            }
            $data->save();
            Toastr::success($msg);
            return redirect()->back();
            } catch (Exception $e) {
               $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back();
         }
     }

     public function ProductDownload($id)
     {
         try {
             $item = Item::findOrfail($id); 
            //  return $item; 
             if (file_exists($item->main_file)) {
                 return Response()->download($item->main_file);
             }else {
                Toastr::error('File not found', 'Error');
                return redirect()->back();
             }
         } catch (Exception $e) {
             $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
         }
     }
     function product_viewSingle(Request $r,$title,$id){
         
        try{
            $data['item'] = Item::find($id);  
            if (is_null($data['item'])) {
               return redirect()->back();
            }
           $data['comment'] = Comment::orderBy('id','desc')->get();
           $data['review'] = Review::orderBy('id','desc')->get();
           $data['BuyerFee'] = BuyerFee::where('status',1)->where('type',1)->first();
           $data['fees']=ItemFee::where('category_id',$data['item']->category_id)->first();
           $data['attributes'] = $data['item']->attribute;
           $level=DB::table('labels')->where('amount','<=',@$data['item']->user->balance->amount)->orderBy('id','desc')->first();
            $item_support=DB::table('item_supports')->first();
           $totalRate =DB::table('reviews')->where('item_id', $data['item']->id)->get();
            $rate5 =DB::table('reviews')->where('item_id', @$data['item']->id)->whereBetween('rating',[4.5,5])->get();
            $rate4 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[3.5,4])->get();
            $rate3 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[2.5,3])->get();
            $rate2 =DB::table('reviews')->where('item_id', @$data['item']->id)->whereBetween('rating',[1.5,2])->get();
            $rate1 =DB::table('reviews')->where('item_id', $data['item']->id)->whereBetween('rating',[.5,1])->get();
            $date=Carbon::parse(Carbon::now())->diffInDays($data['item']->user->created_at);
            $comment = DB::table('comments')->where('status',1)->where('item_id',@$data['item']->id)->count();
            $badge=DB::table('badges')->where('day','<=',@$date)->orderBy('id','desc')->first();
           return view('frontend.pages.singleitem', compact('data','rate5','rate4','rate3','rate2','rate1','totalRate','item_support','level','badge','comment'));
        }catch (Exception $e) {
           $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back(); 
        }
    }

     function content_pending(){

        try {
            $data['item']=Item::where('active_status',1)->where('status','!=', 1)->where('free',0)->orderBy('id','desc')->get();
            return view('backend.product.pending_product', compact('data'));          
          } catch (Exception $e) {
               $msg=str_replace("'", " ", $e->getMessage()) ;
                Toastr::error($msg, 'Failed');
                return redirect()->back();
          }
         
     }
     function item_feedback(Request $r,$id){
        $r->validate([
            'status' => "required",
            'subject' => "required",
        ]);
        DB::beginTransaction();
        try {
            $item = Item::findOrFail($id);
            $feedback = new Feedback();
            $feedback->feedback_by = Auth::id();
            $feedback->subject = $r->subject;
            $feedback->user_id = $item->user_id;
            $feedback->item_id = $item->id;
            $feedback->feedback = @$r->description;
            $feedback->status = $r->status;
            $feedback->save();
            $item->status = $r->status;
            $item->save();
            $data=[
               'username' => $item->user->username,
               'email' => $item->user->email,
               'body' => $r->description,
               'status' => $r->status,
               'url' =>  route('singleProduct',[str_replace(' ', '-',$item->title),$item->id]),
               'title' => $item->title,
            ];
            
            try{
                // Mail::to($item->user->email)->send(new FeedbackMail($data));

                $settings = InfixEmailSetting::first();
                $reciver_email = $item->user->email;
                $receiver_name =  $item->user->full_name;
                $subject = 'Product Review';
                $view ="mail.feedback_mail";
                $compact['data'] =  $data; 
                @send_mail($reciver_email, $receiver_name, $subject , $view ,$compact);

                }catch(Exception $e){
                    $msg = $e->getMessage();
                    Log::info($msg);
                    Toastr::error($msg, 'Failed');
                }
            DB::commit();

            Toastr::success('Succsesfully item feedback sent !','Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
       }
     }
     function itemApprove(Request $r,$id){
        // $r->validate([
        //     'status' => "required",
        //     'subject' => "required",
        // ]);
        DB::beginTransaction();
        try {
            $item = Item::findOrFail($id);
            $feedback = new Feedback();
            $feedback->feedback_by = Auth::id();
            $feedback->subject = '';
            $feedback->user_id = $item->user_id;
            $feedback->item_id = $item->id;
            $feedback->feedback = '';
            $feedback->status = 1;
            $feedback->save();
            $item->status = 1;
            $item->save();
            $data=[
               'username' => $item->user->username,
               'email' => $item->user->email,
               'body' => $r->description,
               'status' => 1,
               'url' =>  route('singleProduct',[str_replace(' ', '-',$item->title),$item->id]),
               'title' => $item->title,
            ];
            try{
                // Mail::to($item->user->email)->send(new FeedbackMail($data));
                
                $settings = InfixEmailSetting::first();
                $reciver_email = $item->user->email;
                $receiver_name =  $item->user->full_name;
                $subject = 'Product Review';
                $view ="mail.feedback_mail";
                $compact['data'] =  $data; 
                @send_mail($reciver_email, $receiver_name, $subject , $view ,$compact);
            }catch(Exception $e){
                Log::info($e->getMessage());
            }
            DB::commit();

            Toastr::success('Succsesfully item Approved !','Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg=str_replace("'", " ", $e->getMessage()) ;
            Toastr::error($msg, 'Failed');
            return redirect()->back();
       }
     }






}