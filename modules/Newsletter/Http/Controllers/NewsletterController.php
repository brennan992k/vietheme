<?php

namespace Modules\Newsletter\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\Newsletter\Entities\InfixNewsletter;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        try {
            $data['newsletter'] = InfixNewsletter::all();
            return view('newsletter::index', compact('data'));
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
            return view('newsletter::create');
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

        try {
            if (empty($request->email)) {
                Toastr::error('Email Is Required', 'Required');
                return redirect()->route('newsletterList');
            } else {

                $request->validate([
                    'email' => "required|unique:infix_newsletter,email",
                ]);


                $newsletter = new InfixNewsletter;
                $newsletter->email = $request->email;
                $result = $newsletter->save();
                // return $newsletter;

                if ($result) {
                    Toastr::success('Email Addedd Succsesfully!', 'Success');
                    return redirect()->route('newsletterList');
                } else {
                    Toastr::error('Something went wrong ! try again ', 'Failed');
                    return redirect()->route('newsletterList');
                }
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function update_subscription(Request $request)
    {

        try {
            if (empty($request->email)) {
                Toastr::error('Email Is Required', 'Required');
                return redirect()->route('newsletterList');
            } else {
                $request->validate([
                    'email' => "required|unique:infix_newsletter,email," . $request->id,
                ]);
                $newsletter = InfixNewsletter::findOrfail($request->id);
                $newsletter->email = $request->email;
                $result = $newsletter->save();
                if ($result) {
                    Toastr::success('Email Updated Succsesfully!', 'Success');
                    return redirect()->route('newsletterList');
                } else {
                    Toastr::error('Something went wrong ! try again ', 'Success');
                    return redirect()->route('newsletterList');
                }
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function email_Delete($id)
    {
        try {
            $newsletter = InfixNewsletter::findOrfail($id);

            $result = $newsletter->delete();
            // return $newsletter;

            if ($result) {
                Toastr::success('Email Deleted Succsesfully!', 'Success');
                return redirect()->route('newsletterList');
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->route('newsletterList');
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function newsletterwPermissionUpdate(Request $request)
    {
        if ($request->status == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }
        $newsletter = InfixNewsletter::find($request->id);
        $newsletter->active_status = $status;
        $newsletter->save();

        return response()->json($request->id);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function emailEdit($id)
    {
        try {
            $newsletter = InfixNewsletter::findOrfail($id);
            $data['newsletter'] = InfixNewsletter::all();
            return view('newsletter::index', compact('newsletter', 'data'));
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
            return view('newsletter::edit');
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
