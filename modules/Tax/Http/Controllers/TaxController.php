<?php

namespace Modules\Tax\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Tax\Entities\Tax;
use App\Models\SpnCountry;
use Exception;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $data['tax'] = Tax::latest()->get();
            $data['country'] = SpnCountry::get();
            return view('tax::index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        try {
            return view('tax::create');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => "required|integer|unique:taxes,country_id",
            'tax' => "required|integer|",
            'status' => "required|",
        ]);
        try {

            $store = new Tax();
            $store->country_id = $request->country_id;
            $store->tax = $request->tax;
            $store->status = $request->status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Tax Added !', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            return view('tax::show');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $data['country'] = SpnCountry::get();
            $data['edit'] = Tax::find($id);
            $data['tax'] = Tax::latest()->get();
            return view('tax::index', compact('data'));
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'country_id' => "required|integer|unique:taxes,country_id," . $request->id,
            'tax' => "required|integer|",
            'status' => "required|",
        ]);
        try {
            $store = Tax::find($request->id);
            $store->country_id = $request->country_id;
            $store->tax = $request->tax;
            $store->status = $request->status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully Tax updated !', 'Success');
                return redirect()->route('admin.tax_list');
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $data = Tax::find($id);
            $data->delete();
            Toastr::success('Succsesfully Tax deleted !', 'Success');
            return redirect()->route('admin.tax_list');
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Error');
            return redirect()->back();
        }
    }
}
