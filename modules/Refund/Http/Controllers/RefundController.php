<?php

namespace Modules\Refund\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Refund\Entities\RefundReason;

class RefundController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try {
            $data['refund'] = RefundReason::latest()->get();
            return view('refund::index', compact('data'));
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
            return view('refund::create');
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
            'name' => "required|string|unique:refund_reasons,name",
            'active_status' => "required|",
        ]);
        try {
            $store = new RefundReason();

            $store->name = $request->name;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully refund added !');
                return redirect()->back();
            } else {
                Toastr::error('Something went wrong ! try again ');
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
            return view('refund::show');
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
            $data['refund'] = RefundReason::latest()->get();
            $data['edit'] = RefundReason::find($id);
            return view('refund::index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
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
            'name' => "required|string|unique:refund_reasons,name," . $request->id,
            'active_status' => "required|",
        ]);
        try {
            $store = RefundReason::find($request->id);
            $store->name = $request->name;
            $store->status = $request->active_status;
            $result = $store->save();

            if ($result) {
                Toastr::success('Succsesfully refund updated !');
                return redirect()->route('admin.refund_list');
            } else {
                Toastr::error('Something went wrong ! try again ');
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
            $data = RefundReason::find($id);
            $data->delete();
            Toastr::success('Succsesfully refund deleted !');
            return redirect()->route('admin.refund_list');
        } catch (Exception $e) {
            $msg = 'This data already used in tables, Please remove those data first';
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
