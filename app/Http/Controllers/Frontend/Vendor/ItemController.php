<?php

namespace App\Http\Controllers\Frontend\Vendor;

use App\Models\Item;
use ZipArchive;
use App\Models\ItemFee;
use App\Models\Attribute;
use App\Models\ItemImage;
use App\Models\ItemPreview;
use App\Models\SessionFile;
use App\Models\ItemCategory;
use App\Models\SubAttribute;
use App\Models\ItemAttribute;
use App\Models\ItemSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Systemsetting\Entities\InfixGeneralSetting;

class ItemController extends Controller
{
    function content()
    {
        try {
            // if (Auth::user()->status == 0) {
            //     Toastr::error('You are not approved yet!', 'Error');
            //     return redirect('/');
            // }
            $data['category'] =  ItemCategory::where('active_status', 1)->take(6)->get();
            $category = ItemCategory::where('up_permission', 1)->get();
            // $attribute = Attribute::all();
            if (Session::get('categorySlect') != null) {
                $attribute = Attribute::join('sub_attributes', 'sub_attributes.attributes_id', '=', 'attributes.id')
                    ->where('category_id', Session::get('categorySlect')->id)
                    ->where('attributes.status', 1)
                    ->distinct('id')
                    ->select('attributes.*')
                    ->get();
            } else {
                $attribute = Attribute::all();
            }
            // return $attribute;
            $sub_attribute = SubAttribute::latest()->get();
            if (@Session::get('categorySlect')) {
                $subCategory = ItemSubCategory::where('item_category_id', Session::get('categorySlect')->id)->get();
                // return $subCategory;
                $item_fee = ItemFee::where('status', 1)->where('category_id', Session::get('categorySlect')->id)->first();
                return view('frontend.vendor.addContent2', compact('category', 'attribute', 'sub_attribute', 'subCategory', 'data', 'item_fee'));
            } else {
                return view('frontend.vendor.addContent2', compact('category', 'attribute', 'sub_attribute', 'data'));
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function contentSelect(Request $r)
    {
        try {
            $category = ItemCategory::find($r->category);
            Session::put('categorySlect', $category);
            return redirect()->route('author.content');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function fileView()
    {
        $files = SessionFile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        foreach ($files as $key => $value) {
            if (!file_exists($value->file_name)) {
                $data = SessionFile::find($value->id);
                $data->delete();
            }
        }
        return response()->json($files, 200);
    }
    function files(Request $r)
    {
        // return response()->json($r, 200);
        $input = $r->all();
        if (@$r->file('file')->extension() == 'png' || $r->file('file')->extension() == 'jpeg') {
            $validator = Validator::make($input, [
                'file' => "required|mimes:jpeg,png|dimensions:width=80,height=80",
            ]);
        } else {
            $validator = Validator::make($input, [
                'file' => "required|mimes:zip",
            ]);
        }
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $fileName = "";
        if ($r->file('file') != "") {
            $file = $r->file('file');
            $fileName = $file->getClientOriginalName();

            if (!file_exists('public/uploads/SessionFile')) {
                mkdir('public/uploads/SessionFile', 0777, true);
            }
            $file->move('public/uploads/SessionFile/', $fileName);
            // $fileName = $fileName;
        }

        $store = new SessionFile();
        $store->user_id = $r->id;

        if ($fileName != "") {
            $store->file_name = $fileName;
        }
        $store->save();
        return response()->json(['files' => json_encode($store)], 200);
    }
    function filesDelete(Request $r)
    {
        return response()->json($r, 200);
        $data = SessionFile::find($r->id);

        if ($data->file_name) {
            File::delete('public/uploads/SessionFile/' . $data->file_name);
        }
        $data->delete();
        $files = SessionFile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return response()->json($files, 200);
    }
    function filesDeleteAdmin(Request $r, $id)
    {
        return response()->json($id, 200);
        $data = SessionFile::find($id);

        if ($data->file_name) {
            File::delete('public/uploads/SessionFile/' . $data->file_name);
        }
        $data->delete();
        $files = SessionFile::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return response()->json($files, 200);
    }

    //item store
    function itemStore(Request $r)
    {
        // return $r;
        // dd($r);
        // Dynamic attribute validation 
        if (@$r->optional_att) {
            $attributes = @$r->optional_att;
            foreach ($attributes as $field_name => $attribute) {
                foreach ($attribute as $key => $value) {
                    if (!is_numeric($value)) {
                        $s = Attribute::where('field_name', $field_name)->select('name')->first();
                        if ($s) {
                            Toastr::error('You have write wrong input for ' . @$s->name, 'Failed');
                        } else {
                            Toastr::error('You have write wrong attributes', 'Failed');
                        }
                        return redirect()->back()->withInput();
                    }
                }
            }
        }
        // End Dynamic attribute validation

        $r->validate([
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'thumdnail' => 'required',
            'theme_preview' => 'required|',
            'category_id' => 'required|',
            'demo_url' => 'required|url',
            'Re_item' => 'required|',
            'Re_buyer' => 'required|',
            'Reg_total_price' => 'required|',
            'E_item' => 'required|',
            'E_buyer' => 'required|',
            'Ex_total_price' => 'required|',
            // 'C_item' => 'sometimes|number',
            // 'C_buyer' => 'sometimes|number',
            // 'C_total_price' => 'sometimes|number',
            'user_msg' => 'sometimes|nullable|string',
            'upload_or_link' => 'required',
            'purchase_link' => 'sometimes|url',
            'tags' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $settings = InfixGeneralSetting::first();
            if ($settings->auto_approve == 1) {
                $approve = 1;
                $success_message = "Product uploaded successfully";
            } else {
                $approve = 0;
                $success_message = "Succsesfully upload your file! Your file is under review !";
            }


            $item = new Item();
            $item->user_id = Auth::user()->id;
            $item->title = $r->title;
            $item->feature1 = $r->feature1;
            $item->feature2 = $r->feature2;
            $item->description = $r->description;
            $item->sub_category_id = $r->sub_category_id;
            $item->category_id = $r->category_id;
            $item->resolution = $r->resolution;
            $item->widget = $r->widget;
            $item->tags = $r->tags;



            // $item->compatible_browsers = implode(",", $r->compatible_browsers);
            // $item->compatible_with = implode(",", $r->compatible_with);
            // $item->framework = implode(",", $r->framework);
            // $item->software_version = implode(",", $r->software_version);



            $item->Re_item = $r->Re_item;
            $item->Re_buyer = $r->Re_buyer;
            $item->Reg_total = $r->Reg_total_price;
            $item->E_item = $r->E_item;
            $item->E_buyer = $r->E_buyer;
            $item->Ex_total = $r->Ex_total_price;

            if (isset($r->C_item)) {
                $item->C_item = $r->C_item;
                $item->C_buyer = $r->C_buyer;
                $item->C_total = $r->C_total_price;
            }

            $item->user_msg = $r->user_msg;
            $item->layout = $r->layout;
            $item->columns = $r->columns;
            $item->demo_url = $r->demo_url;
            $item->active_status = 1;
            $item->status = $approve;
            $item->is_upload = $r->upload_or_link;
            if ($r->upload_or_link == 0) {
                $item->purchase_link = $r->purchase_link;
            }


            //start laravel file validation 
            if ($r->file('thumdnail') == "") {
                Toastr::error('Thumbnail File missing', 'Failed');
                return redirect()->back()->withInput();
            }
            if ($r->file('theme_preview') == "") {
                Toastr::error('Theme Preview File missing', 'Failed');
                return redirect()->back()->withInput();
            }
            if ($r->upload_or_link == 1 && $r->file('main_file') == "") {
                Toastr::error('Main File missing', 'Failed');
                return redirect()->back()->withInput();
            }
            //end laravel file validation 



            $zip = new \ZipArchive();
            $file = $r->file('theme_preview');
            $zip->open($file->path());

            $filesInside = [];
            for ($i = 0; $i < $zip->count(); $i++) {
                $file_name = $zip->getNameIndex($i);
                $exten = substr($file_name, strpos($file_name, ".") + 1);
                if ($exten == 'jpg' || $exten == 'jpeg' || $exten == 'png') {
                    array_push($filesInside, $zip->getNameIndex($i));
                }
            }



            $theme_preview = "";
            if ($r->file('theme_preview') != "") {
                $file = $r->file('theme_preview');
                $theme_preview = 'theme_p-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/SessionFile/', $theme_preview);
                $theme_preview =  'public/uploads/SessionFile/' . $theme_preview;

                $session_file = new SessionFile();
                $session_file->user_id = Auth::user()->id;
                $session_file->file_name = $theme_preview;
                $session_file->save();
            }
            $theme_preview = $theme_preview;
            $dest = 'public/uploads/product/themePreview';


            if ($r->theme_preview && file_exists($theme_preview)) {

                $product_id = Item::max('id') + 1;
                $product_image_path = 'public/uploads/product/themePreview/' . $product_id . '/';
                $Image =  time() . '-';
                if (!file_exists($product_image_path)) {
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

                // return $theme_preview;
                // return $r;


                $filesInFolder = File::files($product_image_path);
                $image_list = [];
                for ($i = 0; $i < $zip->count(); $i++) {

                    $file_name = $zip->getNameIndex($i);
                    $file_exten = explode('.', $file_name);
                    if (@$file_exten[1] == 'jpeg' || @$file_exten[1] == 'png' || @$file_exten[1] == 'jpg') {
                        $image_list[] = $product_image_path . $file_name;
                    }
                }

                $preview_image_list = implode(',', $image_list);
                $item->screen_shot = $preview_image_list;
                $item->theme_preview = $preview_image_list;
                $item->save();
            } else {
                return false;
            }

            $thumbnail = "";
            if ($r->file('thumdnail') != "") {
                $file = $r->file('thumdnail');
                $thumbnail = 'thum-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/product/thumbnail/', $thumbnail);
                $thumbnail =  'public/uploads/product/thumbnail/' . $thumbnail;

                $item->icon = $thumbnail;
                $item->save();
            }

            if (GeneralSetting()->is_s3_host == 0) {
                $main_file1 = '';
                if ($r->file('main_file') != "") {
                    $file = $r->file('main_file');
                    $main_file1 = 'theme_p-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('public/uploads/product/main_file/zip/', $main_file1);
                    $main_file1 =  'public/uploads/product/main_file/zip/' . $main_file1;

                    $item->main_file = $main_file1;
                    $item->save();
                }
            } else {
                if (moduleStatusCheck("AmazonS3")) {
                    $filePath = '/';
                    if ($r->file('main_file') != "") {
                        $path = $r->file('main_file')->store($filePath, 's3');
                        $link = Storage::disk('s3')->url($path);
                        $item->main_file = $link;
                        $item->save();
                    }
                }
            }



            if (@$image_list) {
                $item->thumbnail = $image_list[0];
                $img = new ItemImage();
                $img->item_id = $item->id;
                $img->type = 'theme_preview';
                $img->image = implode(",", $image_list);
                $img->save();
            }
            $item->save();


            if (@$r->optional_att) {
                $attributes = @$r->optional_att;
                foreach ($attributes as $field_name => $attribute) {
                    $ItemAttribute = new ItemAttribute();
                    $ItemAttribute->item_id = $item->id;
                    $ItemAttribute->field_name = $field_name;
                    $ItemAttribute->values =  json_encode($attribute);
                    $ItemAttribute->save();
                }
            }


            Toastr::success($success_message, 'Success');
            DB::commit();

            $data = SessionFile::where('user_id', Auth::user()->id)->get();
            foreach ($data as $key => $value) {
                if ($value->file_name) {
                    File::delete($value->file_name);
                }
                $value->delete();
            }
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function itemEdit($id)
    {
        try {
            $item_preview = ItemPreview::where('item_id', $id)->where('status', 1)->first();
            // return $item_preview;
            $data['edit'] = Item::find($id);
            $data['attributes'] = $data['edit']->attribute;
            if ($data['edit']->user_id != Auth::user()->id) {
                Toastr::error('You are not authorized for view this page', 'Failed');
                return redirect()->back();
            }
            $data['category'] = ItemCategory::where('up_permission', 1)->get();
            $data['subCategory'] = ItemSubCategory::where('active_status', 1)->get();
            $data['attribute'] = Attribute::all();
            $data['sub_attribute'] = SubAttribute::latest()->get();
            $category = ItemCategory::where('up_permission', 1)->get();
            $attribute = Attribute::all();


            return view('frontend.vendor.editContent', compact('data', 'category', 'item_preview'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function itemUpdate(Request $r)
    {

        // return $r;
        // Dynamic attribute validation 
        if (@$r->optional_att) {
            $attributes = @$r->optional_att;
            foreach ($attributes as $field_name => $attribute) {
                foreach ($attribute as $key => $value) {
                    if (!is_numeric($value)) {
                        $s = Attribute::where('field_name', $field_name)->select('name')->first();
                        if ($s) {
                            Toastr::error('You have write wrong input for ' . @$s->name, 'Failed');
                        } else {
                            Toastr::error('You have write wrong attributes', 'Failed');
                        }
                        return redirect()->back()->withInput();
                    }
                }
            }
        }
        // End Dynamic attribute validation



        $r->validate([
            'title' => 'required|string|max:100',
            // 'feature1' => 'required|string|max:45',
            // 'feature2' => 'string|max:45',
            'description' => 'required|string',
            'thumdnail' => 'sometimes|nullable|required|dimensions:max_width=80,max_height=80',
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
            'user_msg' => 'sometimes|nullable|string',
            'tags' => 'required|string',
            'upload_or_link' => 'required',
            'purchase_link' => 'sometimes|url',
        ]);


        DB::beginTransaction();
        try {

            $item_data = Item::find($r->id);


            $settings = InfixGeneralSetting::first();

            if (Auth::user()->role_id == 4) {
                if ($settings->auto_update == 1) {
                    $item = Item::find($r->id);
                    $success_message = "Product Updated successfully";
                } else {
                    $item = new ItemPreview();
                    $item->item_id = $r->id;
                    $success_message = "Thank you for your submission, allow to check 12 to 48 hours";
                }
            } else {
                $item = Item::find($r->id);
                $success_message = "Product Updated successfully";
            }



            // $item =new ItemPreview();
            $item->user_id = Auth::user()->id;

            $item->title = $r->title;
            $item->feature1 = $r->feature1;
            $item->feature2 = $r->feature2;
            $item->description = $r->description;
            $item->sub_category_id = $r->sub_category_id;
            $item->category_id = $r->category_id;
            $item->resolution = $r->resolution;
            $item->widget = $r->widget;
            $item->tags = $r->tags;
            $item->is_upload = $r->upload_or_link;
            if ($r->upload_or_link == 0) {
                $item->purchase_link = $r->purchase_link;
            }

            // $item->compatible_browsers = implode(",", $r->compatible_browsers);
            // $item->compatible_with = implode(",", $r->compatible_with);
            // $item->framework = implode(",", $r->framework);
            // $item->software_version = implode(",", $r->software_version);


            $item->Re_item = $r->Re_item;
            $item->Re_buyer = $r->Re_buyer;
            $item->Reg_total = $r->Reg_total_price;
            $item->E_item = $r->E_item;
            $item->E_buyer = $r->E_buyer;
            $item->Ex_total = $r->Ex_total_price;
            if ($r->C_item) {
                $item->C_item = $r->C_item;
            }
            if ($r->C_total) {
                $item->C_total = $r->C_total;
            }
            $item->C_buyer = $r->C_buyer;
            $item->user_msg = $r->user_msg;
            $item->layout = $r->layout;
            $item->columns = $r->columns;
            $item->demo_url = $r->demo_url;
            $item->active_status = 1;

            //  return $item;
            if ($r->file('theme_preview') == "") {
                $item->thumbnail = $item_data->thumbnail;
            }

            $theme_preview = "";
            if ($r->file('theme_preview') != "") {

                $product_image_path = 'public/uploads/product/themePreview/' . $r->id . '/';

                $zip = new \ZipArchive();
                $file = $r->file('theme_preview');
                $zip->open($file->path());

                $filesInside = [];
                for ($i = 0; $i < $zip->count(); $i++) {
                    $file_name = $zip->getNameIndex($i);
                    $exten = substr($file_name, strpos($file_name, ".") + 1);
                    if ($exten == 'jpg' || $exten == 'jpeg' || $exten == 'png') {
                        array_push($filesInside, $product_image_path . '/' . $zip->getNameIndex($i));
                    }
                }

                $file = $r->file('theme_preview');
                $theme_preview = 'theme_p-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/SessionFile/', $theme_preview);
                $theme_preview =  'public/uploads/SessionFile/' . $theme_preview;

                $session_file = new SessionFile();
                $session_file->user_id = Auth::user()->id;
                $session_file->file_name = $theme_preview;
                $session_file->save();
            }

            if ($theme_preview && file_exists($theme_preview)) {



                $product_id = Item::max('id') + 1;

                $Image =  time() . '-';
                if (!file_exists($product_image_path)) {
                    mkdir($product_image_path, 0777, true);
                }

                $existing_files = File::files($product_image_path);
                foreach ($existing_files as $file) { // iterate files
                    if (is_file($file)) {
                        unlink($file); // delete file
                    }
                }

                $zip_extract = new ZipArchive;
                $res = $zip_extract->open($theme_preview);
                if ($res === TRUE) {
                    $zip_extract->extractTo($product_image_path);
                    $zip_extract->close();
                } else {
                    return false;
                }

                $filesInFolder = File::files($product_image_path);
                $image_list = [];
                for ($i = 0; $i < $zip->count(); $i++) {

                    $file_name = $zip->getNameIndex($i);
                    $file_exten = explode('.', $file_name);
                    if (@$file_exten[1] == 'jpeg' || @$file_exten[1] == 'png' || @$file_exten[1] == 'jpg') {
                        $image_list[] = $product_image_path . $file_name;
                    }
                }

                $preview_image_list = implode(',', $image_list);
                $item->screen_shot = $preview_image_list;
                $item->theme_preview = $preview_image_list;
                $item->save();
            } else {
                $item->theme_preview = $item_data->theme_preview;
            }
            $thumbnail = $item_data->icon;
            if ($r->file('thumdnail') != "") {
                $file = $r->file('thumdnail');
                $thumbnail = 'thum-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/SessionFile/', $thumbnail);
                $thumbnail =  'public/uploads/SessionFile/' . $thumbnail;
            }
            $item->icon = $thumbnail;
            $item->save();

            $main_file1 = $item_data->main_file;

            if ($r->file('main_file') != "") {
                if (GeneralSetting()->is_s3_host == 0) {
                    $file = $r->file('main_file');
                    $main_file1 = 'theme_p-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('public/uploads/product/main_file/zip/', $main_file1);
                    $main_file1 =  'public/uploads/product/main_file/zip/' . $main_file1;
                } else {
                    if (moduleStatusCheck("AmazonS3")) {
                        $filePath = '/';
                        if ($r->file('main_file') != "") {

                            // Storage::delete($item_data->main_file);

                            $path = $r->file('main_file')->store($filePath, 's3');
                            $link = Storage::disk('s3')->url($path);
                            $main_file1 = $link;
                        }
                    }
                }
            }

            $item->file = $main_file1;
            $item->save();
            $main_file2 = $item_data->main_file;
            if ($r->file('file') != "") {

                if (GeneralSetting()->is_s3_host == 0) {
                    $file = $r->file('file');
                    $main_file2 = 'file-' . md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('public/uploads/product/main_file/zip/', $main_file2);
                    $main_file2 =  'public/uploads/product/main_file/zip/' . $main_file2;
                } else {
                    if (moduleStatusCheck("AmazonS3")) {
                        $filePath = '/';
                        if ($r->file('file') != "") {

                            // Storage::delete($item_data->main_file);

                            $path = $r->file('file')->store($filePath, 's3');
                            $link = Storage::disk('s3')->url($path);
                            $main_file2 = $link;
                        }
                    }
                }
            }

            $item->file = $main_file2;
            $item->status = 1;
            $item->save();
            if ($r->theme_preview) {
                if ($filesInside) {
                    $item->thumbnail = $filesInside[0];
                    $img = ItemImage::where('item_id', $item->id)->first();
                    $img->image = implode(",", $filesInside);
                    $img->save();
                }
            }
            $item->save();
            Toastr::success($success_message, 'Success');

            $data = SessionFile::where('user_id', Auth::user()->id)->get();
            foreach ($data as $key => $value) {
                if ($value->file_name) {
                    File::delete($value->file_name);
                }
                $value->delete();
            }



            if (@$r->optional_att) {
                $s = ItemAttribute::where('item_id', $item_data->id)->delete();
                $attributes = @$r->optional_att;
                foreach ($attributes as $field_name => $attribute) {
                    $ItemAttribute = new ItemAttribute();
                    $ItemAttribute->item_id = $item_data->id;
                    $ItemAttribute->field_name = $field_name;
                    $ItemAttribute->values =  json_encode($attribute);
                    $ItemAttribute->save();
                }
            }

            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            // dd($e);
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }














    function fileValidation($file)
    {
        try {
            if (File::extension(@$file) == "zip" || File::extension(@$file) == "ZIP") {
                return $file;
            } else {
                // Toastr::error('File type must be : zip','Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function itemDelete($id)
    {
        try {
            $item = Item::find($id)->update(['active_status' => 0]);
            Toastr::success('Item deleted Successfully', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
