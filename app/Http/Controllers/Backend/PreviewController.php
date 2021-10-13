<?php

namespace App\Http\Controllers\Backend;

use App\Models\Item;
use App\Models\Feedback;
use App\Models\ItemImage;
use App\Models\ItemPreview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Systemsetting\Entities\InfixEmailSetting;

class PreviewController extends Controller
{
    function item_preview()
    {
        try {
            $data = ItemPreview::where(['status' => 1])->orderBy('id', 'desc')->get();
            // return $data;
            return view('backend.product.item_review', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    function item_preview_approve($id)
    {
        DB::beginTransaction();

        try {
            $data = ItemPreview::findOrFail($id);
            if ($data->status == 1) {
                $data->status = 2;
                $msg = 'item active';
                // }else {
                $thumbnail_image = explode(',', $data->theme_preview);
                $thumbnail_image = $thumbnail_image[0];

                $item = Item::find($data->item_id);
                $item->user_id = $data->user_id;
                $item->title = $data->title;
                $item->feature1 = $data->feature1;
                $item->feature2 = $data->feature2;
                $item->icon = $data->icon;
                $item->description = $data->description;
                $item->sub_category_id = $data->sub_category_id;
                $item->category_id = $data->category_id;
                $item->resolution = $data->resolution;
                $item->widget = $data->widget;
                $item->tags = $data->tags;
                $item->compatible_browsers = $data->compatible_browsers;
                $item->compatible_with = $data->compatible_with;
                $item->framework = $data->framework;
                $item->software_version = $data->software_version;
                $item->Re_item = $data->Re_item;
                $item->Re_buyer = $data->Re_buyer;
                $item->Reg_total = $data->Reg_total;
                $item->E_item = $data->E_item;
                $item->E_buyer = $data->E_buyer;
                $item->Ex_total = $data->Ex_total;
                $item->user_msg = $data->user_msg;
                $item->layout = $data->layout;
                $item->columns = $data->columns;
                $item->demo_url = $data->demo_url;
                $item->is_upload = $data->is_upload;
                if ($data->upload_or_link == 0) {
                    $item->purchase_link = $data->purchase_link;
                }

                $item->main_file = $data->file;
                $item->icon = $data->icon;
                $item->thumbnail = $data->thumbnail;
                $item->theme_preview = $data->theme_preview;

                // if (Str::contains($data->theme_preview, ',')) {
                //     $item->thumbnail = $thumbnail_image;
                // } else {
                //     $item->thumbnail = $data->thumbnail;
                // }

                //    $item->thumbnail = $thumbnail_image;
                $item->screen_shot = $data->theme_preview;


                //jhg
                $item->status = 1;
                $item->active_status = 1;
                $item->save();
                $img = ItemImage::where('item_id', $item->id)->first();
                $img->type = 'theme_preview';
                $img->image = $data->theme_preview;
                $img->save();

                //    if ($data->thumdnail) {            
                //        if (file_exists($data->thumdnail)) {
                //            $end=explode('/',$data->thumdnail);
                //            $file = end($end);
                //            $destFil ='public/uploads/product/thumbnail/'.$file;
                //            File::move($data->thumdnail,$destFil);
                //            $item->thumbnail = $destFil;
                //            $item->save();
                //         }
                //     }

                //    if ($data->theme_preview) {                          
                //        //$theme_preview;
                //        $dest= 'public/uploads/product/themePreview/';
                //        $theme_preview = $data->theme_preview;
                //        $zip = new ZipArchive();           
                //        if (file_exists($theme_preview)) {

                //        $zip->open($theme_preview, ZipArchive::CREATE);
                //        $preview=[];
                //        $file_count = $zip->numFiles;
                //        if ( $zip == true )
                //        { 

                //               if (file_exists($data->theme_preview)) {
                //                   $end=explode('/',$theme_preview);
                //                   $file = end($end);
                //               }
                //                $destFile='public/uploads/product/themePreview/zip/'.time().'-'.$file;
                //                if (!file_exists($dest.'/zip/')){
                //                    mkdir($dest.'/zip/', 0777, true);
                //                    File::move($theme_preview,$destFile);
                //                }else{
                //                 File::move($theme_preview,$destFile);

                //                }

                //            for ( $i=0; $i < $zip->numFiles; $i++ )
                //            {
                //                $entry = $zip->getNameIndex($i);           
                //                if ( substr( $entry, -1 ) == '/' ) continue; // skip directories 
                //                $pattern = '/(^._|.DS_Store|__MACOSX)/';
                //                $matched = preg_match($pattern, $entry, $matches);
                //                if ($matched) { 
                //                    //echo $entry; print_r($matches);
                //                    continue;
                //                }
                //                $base = basename(uniqid() . '-'.$entry);   
                //                $fp = $zip->getStream( $entry );        
                //                if (preg_match('/(\.jpg|\.png|)$/i', $entry)) {
                //                   $ofp = fopen( $dest.'/'.$base, 'w' );
                //                   array_push($preview,'public/uploads/product/themePreview/'.$base);
                //                if ( ! $fp )
                //                    throw new \Exception('Unable to extract the file.');

                //                while ( ! feof( $fp ) )
                //                    fwrite( $ofp, fread($fp, 8192) );

                //                fclose($fp);
                //                fclose($ofp);
                //                }
                //            }
                //            $item->theme_preview = $destFile;
                //            $item->save();
                //            $zip->close();


                //            }
                //            else{
                //                return false;
                //            }
                //                $img = $item->item_image;
                //                $img->item_id = $item->id;
                //                $img->image = implode(",",$preview);
                //                foreach (explode(',',$item->item_image->image) as $key => $value) {
                //                    File::delete('public/uploads/product/themePreview/'.$value);
                //                }
                //                $img->save();           
                //        }
                //    }


                //   if ($data->main_file) {                                             
                //            if (file_exists($data->main_file)) {
                //                $main_file = $data->main_file;
                //                $end=explode('/',$main_file);
                //                $file = end($end);
                //                 $destFile= 'public/uploads/product/main_file/zip/'.time().'-'.$file;
                //                 $dest = 'public/uploads/product/main_file/zip/';
                //                 if (!file_exists($dest)){
                //                     mkdir($dest, 0777, true);
                //                     File::move($main_file,$destFile);
                //                 }else{
                //                     File::move($main_file,$destFile);
                //                 }
                //                 $item->main_file = $destFile;
                //                 $item->save();
                //     }
                //     }
                //    if (file_exists($data->file)) {
                //        $main_file = $data->file;
                //        $end=explode('/',$main_file);
                //        $file = end($end);           
                //         $destFile= 'public/uploads/product/file/zip/'.time().'-'.$file;
                //         $dest = 'public/uploads/product/file/zip/';
                //         if (!file_exists($dest)){
                //             mkdir($dest, 0777, true);
                //             File::move($main_file,$destFile);
                //         }else{
                //             File::move($main_file,$destFile);
                //         }
                //         $item->file = $destFile;
                //         $item->save();
                //   }       

                $msg = 'Succsesfully approved file!';
            }

            DB::commit();
            $data->delete();
            Toastr::success($msg);
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function item_preview_deactive($id)
    {
        DB::beginTransaction();

        try {
            $data = ItemPreview::findOrFail($id);
            if ($data->status == 1) {
                $data->status = 2;
                $msg = 'item de-active';


                DB::commit();
                $data->update();
                Toastr::success($msg);
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
            $item = ItemPreview::find($id)->update(['status' => 0]);
            Toastr::success('Item deleted Successfully', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function item_feedback(Request $r, $id)
    {
        $r->validate([
            'status' => "required",
            'subject' => "required",
        ]);
        DB::beginTransaction();
        try {
            $item = ItemPreview::findOrFail($id);
            $feedback = new Feedback();
            $feedback->feedback_by = Auth::id();
            $feedback->subject = $r->subject;
            $feedback->user_id = $item->user_id;
            $feedback->item_id = $item->item_id;
            $feedback->feedback = @$r->description;
            $feedback->status = $r->status;
            $feedback->save();
            $item->active_status = $r->status;
            $item->save();
            $to_email = $item->user->email;
            $to_name = $item->user->username;
            if (@$r->status == 1) {
                $this->item_preview_approve($id);

                if (@Adminmailsetting($item->user_id)->item_update == 1) {
                    $data_info['message'] = isset($r->description) ? $r->description  : $r->subject;
                    $email_sms_title = 'Product review';
                    MailNotification($data_info, $to_name, $to_email, $email_sms_title);
                }
            }
            $data = [
                'username' => $to_name,
                'email' => $to_email,
                'body' => isset($r->description) ? $r->description  : $r->subject,
                'status' => $r->status,
                'url' =>  route('singleProduct', [str_replace(' ', '-', $item->title), $item->id]),
                'title' => $item->title,
            ];


            if (@Adminmailsetting($item->user_id)->item_review == 1) {



                try {
                    // Mail::to($item->user->email)->send(new FeedbackMail($data));

                    $settings = InfixEmailSetting::first();
                    $reciver_email = $item->user->email;
                    $receiver_name =  $item->user->full_name;
                    $subject = 'Product Review';
                    $view = "mail.feedback_mail";
                    $compact['data'] =  $data;
                    @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    Log::info($msg);
                    Toastr::error($msg, 'Failed');
                }
            }

            DB::commit();

            Toastr::success('Succsesfully item feedback sent !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function item_feedback_direct(Request $r, $id)
    {
        $status = 1;
        DB::beginTransaction();
        try {
            $item = ItemPreview::findOrFail($id);
            // $feedback = new Feedback();
            // $feedback->feedback_by = Auth::id();
            // $feedback->subject = $r->subject;
            // $feedback->user_id = $item->user_id;
            // $feedback->item_id = $item->item_id;
            // $feedback->feedback = @$r->description;
            // $feedback->status = $r->status;
            // $feedback->save();
            $item->active_status =  $status;
            $item->save();
            $to_email = $item->user->email;
            $to_name = $item->user->username;

            $this->item_preview_approve($id);

            if (@Adminmailsetting($item->user_id)->item_update == 1) {
                $data_info['message'] = isset($r->description) ? $r->description  : $r->subject;
                $email_sms_title = 'Product review';
                MailNotification($data_info, $to_name, $to_email, $email_sms_title);
            }

            $data = [
                'username' => $to_name,
                'email' => $to_email,
                'body' => isset($r->description) ? $r->description  : $r->subject,
                'status' =>  $status,
                'url' =>  route('singleProduct', [str_replace(' ', '-', $item->title), $item->id]),
                'title' => $item->title,
            ];


            if (@Adminmailsetting($item->user_id)->item_review == 1) {


                try {
                    // Mail::to($item->user->email)->send(new FeedbackMail($data));

                    $settings = InfixEmailSetting::first();
                    $reciver_email = $item->user->email;
                    $receiver_name =  $item->user->full_name;
                    $subject = 'Product Review';
                    $view = "mail.feedback_mail";
                    $compact['data'] =  $data;
                    @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    Log::info($msg);
                    Toastr::error($msg, 'Failed');
                }
            }

            DB::commit();

            Toastr::success('Succsesfully item feedback sent !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
