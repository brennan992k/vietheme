<?php

namespace Modules\HumanResource\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\HumanResource\Entities\InfixDepartment;

class SmHumanDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        try {
            $departments = InfixDepartment::all();
            return view('humanresource::departmentHumen', compact('departments'));
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
            return view('humanresource::create');
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
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:255'
        ]);
        try {
            $dp = new InfixDepartment();
            $dp->name = $request->name;
            $dp->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
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
            return view('humanresource::show');
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
            $departments = InfixDepartment::all();
            $department = InfixDepartment::findOrFail($id);
            return view('humanresource::departmentHumen', compact('departments', 'department'));
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
        $departments = InfixDepartment::all();

        $request->validate([
            'name' => 'required|'
        ]);
        try {
            $dp = InfixDepartment::findOrFail($id);
            $dp->name = $request->name;
            $dp->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('admin.department');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicketcategory');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function department_delete($id)
    {
        try {
            $department = InfixDepartment::findOrFail($id);
            $department->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect('humanresource/department');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
