<?php

namespace Modules\KnowledgeBase\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\KnowledgeBase\Entities\InfixKnowledgeBase;
use Modules\KnowledgeBase\Entities\InfixKnowledgeBaseCategory;
use Modules\KnowledgeBase\Entities\InfixKnBaseCategoryQuestion;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class KnowledgeBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function categoryList()
    {
        try {
            $data['knowledge_categories'] = InfixKnowledgeBaseCategory::get();
            return view('knowledgebase::knowledge_base_category', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:infix_knowledge_base_category,name",
        ]);
        try {
            $knowledge_categories = new InfixKnowledgeBaseCategory();
            $knowledge_categories->name = $request->name;
            $result = $knowledge_categories->save();
            Toastr::success('Succsesfully Category Added !', 'Success');
            return redirect()->route('KnowledgeBaseCategoryList');
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('KnowledgeBaseCategoryList');
        }
    }
    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'name' => "required|string",
        ]);
        try {
            $knowledge_categories = InfixKnowledgeBaseCategory::find($request->id);
            $knowledge_categories->name = $request->name;
            $knowledge_categories->active_status = $request->status;
            $result = $knowledge_categories->save();
            Toastr::success('Succsesfully Category Updated !', 'Success');
            return redirect()->route('KnowledgeBaseCategoryList');
        } catch (Exception $e) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('KnowledgeBaseCategoryList');
        }
    }
    public function editCategory($id)
    {
        try {
            $data['knowledge_categories'] = InfixKnowledgeBaseCategory::get();
            $data['edit'] = InfixKnowledgeBaseCategory::find($id);
            return view('knowledgebase::knowledge_base_category', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function deleteQuestion($id)
    {
        $tables = InfixKnowledgeBase::where('question_id', $id)->first();

        try {
            if ($tables == null) {

                $delete_query = DB::table('infix_category_question')->where('id', $id)->delete();

                Toastr::success('Succsesfully Deleted!', 'Success');
                return redirect()->back();
            } else {
                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (QueryException $e) {

            $msg = 'This data already used in tables, Please remove those data first';
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function deleteCategory($id)
    {

        $tables = DB::table('infix_category_question')->where('category_id', $id)->first();

        try {
            if ($tables == null) {

                $delete_query = DB::table('infix_knowledge_base_category')->where('id', $id)->delete();

                Toastr::success('Succsesfully Deleted!', 'Success');
                return redirect()->back();
            } else {
                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (QueryException $e) {

            $msg = 'This data already used in tables, Please remove those data first';
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    //Knowledge Base Category Question Start

    public function categoryQuestion()
    {
        try {
            $data['categories'] = InfixKnowledgeBaseCategory::where('active_status', 1)->get();
            $data['category_questions'] = InfixKnBaseCategoryQuestion::join('infix_knowledge_base_category', 'infix_category_question.category_id', '=', 'infix_knowledge_base_category.id')
                ->select('first_question', 'name', 'infix_category_question.id')
                ->get();
            // return $data['category_questions'];
            return view('knowledgebase::category_question', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function categoryQuestionEdit($id)
    {
        try {
            $data['categories'] = InfixKnowledgeBaseCategory::where('active_status', 1)->get();
            $data['category_questions'] = InfixKnBaseCategoryQuestion::join('infix_knowledge_base_category', 'infix_category_question.category_id', '=', 'infix_knowledge_base_category.id')->get();
            $data['edit'] = InfixKnBaseCategoryQuestion::find($id);
            return view('knowledgebase::category_question', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function storeQuestion(Request $request)
    {
        $request->validate([
            'category' => "required",
            'first_question' => "required|string|max:300",
        ]);
        try {
            $question = new InfixKnBaseCategoryQuestion();
            $question->category_id = $request->category;
            $question->first_question = $request->first_question;
            $question->created_by = Auth::user()->id;
            $result = $question->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('categoryQuestion');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->route('categoryQuestion');
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('categoryQuestion');
        }
    }
    public function updateQuestion(Request $request)
    {
        $request->validate([
            'category' => "required",
            'first_question' => "required|string|max:300",
        ]);
        try {
            $question = InfixKnBaseCategoryQuestion::find($request->id);
            $question->category_id = $request->category;
            $question->first_question = $request->first_question;
            $question->created_by = Auth::user()->id;
            $result = $question->save();
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('categoryQuestion');
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->route('categoryQuestion');
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('categoryQuestion');
        }
    }

    //Knowledge Base Category Question  End

    public function index()
    {
        try {
            $data['categories'] = InfixKnowledgeBaseCategory::where('active_status', 1)->get();
            return view('knowledgebase::index', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function SearchQuestion(Request $request)
    {
        $request->validate([
            'category' => "required",
        ]);
        try {
            $data['categories'] = InfixKnowledgeBaseCategory::where('active_status', 1)->get();
            $data['knowledge_base'] = InfixKnowledgeBase::join('infix_category_question', 'infix_category_question.id', '=', 'infix_knowledge_base.question_id')
                ->select('infix_knowledge_base.id', 'first_question', 'sub_question', 'answer', 'name')
                ->join('infix_knowledge_base_category', 'infix_knowledge_base_category.id', '=', 'infix_category_question.category_id')
                ->where('infix_knowledge_base_category.id', $request->category);
            // $data['knowledge_base'] = InfixKnowledgeBase::join('infix_category_question', 'infix_category_question.id', '=', 'infix_knowledge_base.question_id')
            // ->select('infix_knowledge_base.id', 'first_question', 'sub_question', 'answer', 'name')
            // ->join('infix_knowledge_base_category', 'infix_knowledge_base_category.id', '=', 'infix_category_question.category_id')            
            // ->where('infix_knowledge_base.question_id',$request->category);

            if (@$request->key) {
                $data['knowledge_base'] = $data['knowledge_base']
                    ->orWhere('infix_knowledge_base.sub_question', 'like', '%' . $request->key . '%')
                    ->orWhere('infix_knowledge_base_category.name', 'like', '%' . $request->key . '%');
            }
            $data['knowledge_base'] = $data['knowledge_base']->get();
            $data['category'] = $request->category;
            $data['key'] = $request->key;
            return view('knowledgebase::index', compact('data'));
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('categoryQuestion');
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        try {
            $data['questions'] = DB::table('infix_category_question')->join('infix_knowledge_base_category', 'infix_knowledge_base_category.id', '=', 'infix_category_question.category_id')->where('active_status', 1)
                ->select('infix_category_question.id', 'infix_category_question.category_id', 'infix_category_question.first_question', 'infix_knowledge_base_category.active_status', 'infix_knowledge_base_category.name')->get();
            // return $data['questions'];
            return view('knowledgebase::create_knowledge_base', compact('data'));
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
        // return $request;

        $request->validate([
            'question' => "required",
            'sub_question' => "required|max:1000",
            'answer' => "required",
        ]);
        try {
            $kn_base = new InfixKnowledgeBase();
            $kn_base->question_id = $request->question;
            $kn_base->sub_question = $request->sub_question;
            $kn_base->answer = $request->answer;
            $kn_base->answered_by = Auth::user()->id;
            $result = $kn_base->save();

            if ($result) {
                Toastr::success('Question & Answer Added Succsesfully!', 'Success');
                return redirect()->route('questionList');
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->route('questionList');
            }
        } catch (Exception $e) {
            return $e;
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('questionList');
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
            $data['edit'] = InfixKnowledgeBase::find($id);
            $data['questions'] = DB::table('infix_category_question')->join('infix_knowledge_base_category', 'infix_knowledge_base_category.id', '=', 'infix_category_question.category_id')
                ->select('infix_category_question.id', 'infix_category_question.first_question', 'infix_knowledge_base_category.name')->get();
            // return  $data['edit'];
            return view('knowledgebase::update_kn_base', compact('data'));
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
            return view('knowledgebase::edit');
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

        // return $request;

        $request->validate([
            'question' => "required",
            'sub_question' => "required|max:1000",
            'answer' => "required",
        ]);
        try {
            $kn_base = InfixKnowledgeBase::find($request->id);
            $kn_base->question_id = $request->question;
            $kn_base->sub_question = $request->sub_question;
            $kn_base->answer = $request->answer;
            $kn_base->answered_by = Auth::user()->id;
            $result = $kn_base->save();

            if ($result) {
                Toastr::success('Question & Answer Updated Succsesfully!', 'Success');
                return redirect()->route('questionList');
            } else {
                Toastr::error('Something went wrong ! try again ', 'Success');
                return redirect()->route('questionList');
            }
        } catch (Exception $e) {
            return $e;
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('questionList');
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
            $result = InfixKnowledgeBase::destroy($id);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
}
