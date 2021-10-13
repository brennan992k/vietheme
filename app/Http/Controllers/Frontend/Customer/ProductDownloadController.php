<?php

namespace App\Http\Controllers\Frontend\Customer;

use PDF;
use App\Models\Item;
use App\Models\User;
use ZipArchive;
use App\Models\ItemOrder;
use App\Models\PurchaseCode;
use App\Models\ItemUpdateNotify;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as SAVEPDF;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Systemsetting\Entities\InfixGeneralSetting;

class ProductDownloadController extends Controller
{
    public function ProductDownload(Request $request, $id)
    {
        try {
            $order_details = ItemOrder::findOrfail($id);
            $order_details->download_status = 1;
            $order_details->save();
            $author_details = User::findOrfail($order_details->author_id);
            $user_details = User::findOrfail($order_details->user_id);
            $item_details = Item::findOrfail($order_details->item_id);
            // return $item_details;
            if (purchaseCheck(Auth::user()->id, $order_details->item_id) == false) {
                Toastr::error('You have not purchased this product', 'Failed');
                return redirect()->back();
            }
            // $file = explode('/', $item_details->file);
            // $file_name = $file[5];

            // $file = public_path() . '/uploads/product/file/zip/' . $file_name;
            if (file_exists($item_details->file)) {
                return Response()->download($item_details->file);
            } else {
                Toastr::error('File not found', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function LicenceDownload($id)
    {
        try {
            $order_details = ItemOrder::findOrfail($id);
            $order_details->download_status = 1;
            $order_details->save();
            $author_details = User::findOrfail($order_details->author_id);
            $user_details = User::findOrfail($order_details->user_id);
            $item_details = Item::findOrfail($order_details->item_id);
            $purchase_code = PurchaseCode::where('order_id', '=', $id)->first();
            $settings = InfixGeneralSetting::findOrfail(1);
            // $order_item =  $order_details->item;
            if (purchaseCheck(Auth::user()->id, $order_details->item_id) == false) {
                Toastr::error('You have not purchased this product', 'Failed');
                return redirect()->back();
            }
            $order_item =  explode(',', $order_details->item, true);;

            $pdf = PDF::loadView('frontend/vendor/licence_pdf', ['order_details' => $order_details, 'author_details' => $author_details, 'user_details' => $user_details, 'item_details' => $item_details, 'purchase_code' => $purchase_code, 'settings' => $settings]);
            // return view('frontend/vendor/licence_pdf',compact('order_details','author_details','user_details','item_details','purchase_code'));
            $pdf->setPaper('A4', 'landscape');
            $filename = $item_details->id . '_licence.pdf';
            return $pdf->download($filename);
            $license_location = 'public/uploads/product/license/' . $filename;
            File::delete($license_location);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function ProductLicence(Request $request, $id)
    {
        try {

            //=========== START FILES DATA==============
            $order_details = ItemOrder::findOrfail($id);
            $order_details->download_status = 1;
            $order_details->save();
            $author_details = User::findOrfail($order_details->author_id);
            $user_details = User::findOrfail($order_details->user_id);
            $item_details = Item::findOrfail($order_details->item_id);

            if (purchaseCheck(Auth::user()->id, $order_details->item_id) == false) {
                Toastr::error('You have not purchased this product', 'Failed');
                return redirect()->back();
            }

            $purchase_code = PurchaseCode::where('order_id', '=', $id)->first();
            $settings = InfixGeneralSetting::findOrfail(1);
            $pdf = SAVEPDF::loadView('frontend/vendor/licence_pdf', ['order_details' => $order_details, 'author_details' => $author_details, 'user_details' => $user_details, 'item_details' => $item_details, 'purchase_code' => $purchase_code, 'settings' => $settings]);

            $pdf->setPaper('A4', 'landscape');
            $filename = $item_details->id . '_licence.pdf';
            $pdf->save('public/uploads/product/license/' . $filename);
            $license_location = 'public/uploads/product/license/' . $filename;
            if (GeneralSetting()->is_s3_host == 0) {
                $file_location = $item_details->main_file;
            } else {
                $s3_file_name = str_replace(' ', '_', $item_details->title) . '_' . time() . '.zip';
                $contents = file_get_contents($item_details->main_file);
                Storage::disk('download')->put($s3_file_name, $contents);
                $s3_file_location = public_path('s3_files/' . $s3_file_name);
                $file_location = $s3_file_location;
            }


            $files = [
                $file_location,
                $license_location,
            ];
            //===========END FILES DATA==============
            $date_time = str_replace(' ', '_', \Carbon\Carbon::now()->format('Y-m-d_H.i.s'));
            $zip_file_name = str_replace(' ', '_', $item_details->title . '_' . $date_time . '_' . @$order_details->item_id . '.zip'); // Name of our archive to download


            $new_file_array = [];

            foreach ($files as $key => $file) {

                $file_name_array = explode('/', $file);
                $file_original = $file_name_array[array_key_last($file_name_array)];
                $new_file_array[$key]['path'] = $file;
                $new_file_array[$key]['name'] = $file_original;
            }
            // return  $new_file_array;
            $public_dir = public_path();
            $zip = new ZipArchive;
            if ($zip->open($public_dir . '/' . $zip_file_name, ZipArchive::CREATE) === TRUE) {
                // Add Multiple file   
                foreach ($new_file_array as $key => $file) {
                    $zip->addFile($file['path'], @$file['name']);
                }
                $zip->close();
            }

            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath = $public_dir . '/' . $zip_file_name;
            // Create Download Response
            if (file_exists($filetopath)) {
                return Response::download($filetopath)->deleteFileAfterSend(true);
            }

            if (GeneralSetting()->is_s3_host == 0) {
                File::delete($filetopath);
            } else {
                File::delete($s3_file_location);
            }
            File::delete($license_location);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function ItemUpdateNotify($id)
    {
        try {
            $email_notify = ItemUpdateNotify::firstOrCreate(['user_id' => Auth::id(), 'item_id' => $id]);
            if (@$email_notify->notify == 1) {
                $email_notify->notify = 0;
            } else {
                $email_notify->notify = 1;
            }
            $email_notify->save();
            return response()->json(['success' => 'operation success']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong! please try again']);
        }
    }


    // free download 

    public function FreeProductLicence(Request $request, $id)
    {
        try {

            //=========== START FILES DATA==============
            $item_details = Item::findOrfail($id);
            $user_details = User::findOrfail(Auth::id());
            $author_details = $item_details->user;
            // $author_details = User::findOrfail($order_details->author_id);

            $purchase_code = 'Free';
            $settings = InfixGeneralSetting::findOrfail(1);
            // $pdf = SAVEPDF::loadView('frontend/vendor/licence_pdf', ['author_details' => $author_details, 'user_details' => $user_details, 'item_details' => $item_details, 'purchase_code' => $purchase_code, 'settings' => $settings]);

            $pdf = SAVEPDF::loadView('frontend/vendor/free_licence_pdf', ['purchase_code' => $purchase_code, 'author_details' => $author_details, 'user_details' => $user_details, 'item_details' => $item_details,  'settings' => $settings]);

            $pdf->setPaper('A4', 'landscape');
            $filename = $item_details->id . '_licence.pdf';
            $pdf->save('public/uploads/product/license/' . $filename);
            $license_location = 'public/uploads/product/license/' . $filename;
            $file_location = $item_details->file;
            $files = [
                $file_location,
                $license_location,
            ];
            //===========END FILES DATA==============

            $zip_file_name = str_replace(' ', '_', $item_details->title . time() . '.zip'); // Name of our archive to download


            $new_file_array = [];

            foreach ($files as $key => $file) {

                $file_name_array = explode('/', $file);
                $file_original = $file_name_array[array_key_last($file_name_array)];
                $new_file_array[$key]['path'] = $file;
                $new_file_array[$key]['name'] = $file_original;
            }

            $public_dir = public_path();
            $zip = new ZipArchive;
            if ($zip->open($public_dir . '/' . $zip_file_name, ZipArchive::CREATE) === TRUE) {
                // Add Multiple file   
                foreach ($new_file_array as $key => $file) {
                    $zip->addFile($file['path'], $file['name']);
                }
                $zip->close();
            }

            $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
            $filetopath = $public_dir . '/' . $zip_file_name;
            // Create Download Response
            if (file_exists($filetopath)) {
                return Response::download($filetopath)->deleteFileAfterSend(true);
            }
            File::delete($filetopath);
            File::delete($license_location);
        } catch (Exception $e) {

            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function FreeProductLicenceOld(Request $request, $id)
    {
        try {

            //=========== START FILES DATA==============
            $item_details = Item::findOrfail($id);
            $user_details = User::findOrfail(Auth::id());
            $author_details = $item_details->user;
            $settings = InfixGeneralSetting::findOrfail(1);
            $purchase_code = 'Free';
            $pdf = SAVEPDF::loadView('frontend/vendor/free_licence_pdf', ['purchase_code' => $purchase_code, 'author_details' => $author_details, 'user_details' => $user_details, 'item_details' => $item_details,  'settings' => $settings]);

            $pdf->setPaper('A4', 'landscape');
            $filename = $item_details->id . '_licence.pdf';
            $pdf->save('public/uploads/product/license/' . $filename);
            $license_location = 'public/uploads/product/license/' . $filename;
            $file_location = $item_details->file;
            $files = [
                'product' => $file_location,
                'license' => $license_location,
            ];
            //===========END FILES DATA==============

            $zip_file_name = str_replace(' ', '_', $item_details->title); // Name of our archive to download

            $new_zip_path = 'public/downloadable_zip/';
            $zipname = str_replace('.', '_', $zip_file_name) . '.zip';
            $file_path = $new_zip_path . $zipname;
            $zip = new ZipArchive;
            $zip->open($new_zip_path . $zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
            foreach ($files as $file) {
                $zip->addFile($file);
            }
            $zip->close();

            ///Then download the zipped file.

            header('Content-Type: application/zip');
            header('Content-disposition: attachment; filename=' . $file_path);
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);

            File::delete($file_path);
            File::delete($license_location);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function FreeProductDownload(Request $request, $id)
    {
        try {
            $item_details = Item::findOrfail($id);
            // return $item_details;

            $file = explode('/', $item_details->file);
            $file_name = $file[5];

            $file = public_path() . '/uploads/product/file/zip/' . $file_name;
            if (file_exists($file)) {
                return Response()->download($file);
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function FreeLicenceDownload($id)
    {
        try {
            $item_details = Item::findOrfail($id);
            $user_details = User::findOrfail(Auth::id());
            $author_details = $item_details->user;
            $settings = InfixGeneralSetting::findOrfail(1);
            $purchase_code = 'Free';
            $pdf = SAVEPDF::loadView('frontend/vendor/free_licence_pdf', ['author_details' => $author_details, 'purchase_code' => $purchase_code, 'user_details' => $user_details, 'item_details' => $item_details,  'settings' => $settings]);

            $pdf->setPaper('A4', 'landscape');
            $filename = $item_details->id . '_licence.pdf';
            return $pdf->download($filename);
            $license_location = 'public/uploads/product/license/' . $filename;
            File::delete($license_location);
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
