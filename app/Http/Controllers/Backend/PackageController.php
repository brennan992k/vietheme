<?php

namespace App\Http\Controllers\Backend;

use App\Models\Package;
use App\Models\PackageType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\File;

class PackageController extends Controller
{
    /* ********************* START  PACKAGE TYPE *************************  */
    public function package_type()
    {
        try {
            $data['fee'] = PackageType::all();
            return view('backend.package.package_type', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function package_typeStore(Request $request)
    {

        $request->validate([
            'name' => "required|string|unique:package_types,name",
            'month' => "required|",
            'half_year' => "required|",
            'year' => "required|",
            'active_status' => "required|",
        ]);
        try {
            $store = new PackageType();
            $store->name = $request->name;
            $store->slug = strtolower(str_replace(' ', '_', $request->name));
            $store->month = $request->month;
            $store->half_year = $request->half_year;
            $store->year = $request->year;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Package Type Added !', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ', 'Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function editpackage_type($id)
    {
        try {
            $data['fee'] = PackageType::all();
            $data['edit'] = PackageType::find($id);
            return view('backend.package.package_type', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatepackage_type(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:package_types,name," . $request->id,
            'month' => "required|",
            'half_year' => "required|",
            'year' => "required|",
            'active_status' => "required|",
        ]);
        try {
            $store = PackageType::find($request->id);

            $store->name = $request->name;
            $store->slug = strtolower(str_replace(' ', '_', $request->name));
            $store->month = $request->month;
            $store->half_year = $request->half_year;
            $store->year = $request->year;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Package Type updated !', 'Success');
                return redirect()->route('admin.package_type');
            } else {
                Toastr::error('Something went wrong ! try again ', 'Error');
                return redirect()->route('');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function deletepackage_type($id)
    {
        try {
            $data = PackageType::find($id);
            $data->delete();
            Toastr::success('Succsesfully Package Type deleted !', 'Success');
            return redirect()->route('admin.package_type');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /* *********************  END PACKAGE TYPE  *************************  */



    /* *********************  START PACKAGE  *************************  */

    function package()
    {
        try {
            $data['package_type'] = PackageType::latest()->get();
            $data['package'] = Package::latest()->get();
            return view('backend.package.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function packageStore(Request $request)
    {

        $request->validate([
            'package_type' => "required|unique:packages,package_type,",
            'description' => "required|",
            'total_item' => "required|integer",
            'active_status' => "required|",
            "image"  => "required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=80,max_height=80",
        ]);
        try {

            $image = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                if (!file_exists('public/uploads/package')) {
                    mkdir('public/uploads/package', 0777, true);
                }
                $file->move('public/uploads/package/', $image);
                $image = 'public/uploads/package/' . $image;
            }

            $store = new Package();
            $store->package_type = $request->package_type;
            $store->description = $request->description;
            $store->total_item = $request->total_item;
            $store->status = $request->active_status;
            $store->image = $image;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully package Added !', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ', 'Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function editpackage($id)
    {
        try {
            $data['package_type'] = PackageType::latest()->get();
            $data['package'] = Package::all();
            $data['edit'] = Package::find($id);
            return view('backend.package.index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function updatepackage(Request $request)
    {
        $request->validate([
            'package_type' => "required|unique:packages,package_type," . $request->id,
            'description' => "required|",
            'total_item' => "required|integer",
            'active_status' => "required|",
            "image"  => "required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=80,max_height=80",
        ]);
        try {
            $store = Package::find($request->id);
            $image = "";
            if ($request->file('image') != "") {
                $file = $request->file('image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                if (!file_exists('public/uploads/package')) {
                    mkdir('public/uploads/package', 0777, true);
                }
                $file->move('public/uploads/package/', $image);
                $image = 'public/uploads/package/' . $image;
                File::delete($store->image);
            }

            $store->package_type = $request->package_type;
            $store->description = $request->description;
            $store->total_item = $request->total_item;
            $store->status = $request->active_status;
            if ($image != "") {
                $store->image = $image;
            }
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully package updated !', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function deletepackage($id)
    {
        try {
            $data = Package::find($id);
            if ($data->iamge != 'public/uploads/package/package-0.png') {
                File::delete($data->iamge);
            }
            $data->delete();
            Toastr::success('Succsesfully package deleted !', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
