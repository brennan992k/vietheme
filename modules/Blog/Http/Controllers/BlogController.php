<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Modules\Blog\Entities\InfixBlog;
use Modules\Blog\Entities\InfixBlogCategory;

class BlogController extends Controller
{

    public function categoryList()
    {
        $data['blog_categories'] = InfixBlogCategory::get();
        return view('blog::blog_category', compact('data'));
    }

    public function blogAdd()
    {
        $data['categories'] = InfixBlogCategory::where('status', 1)->get();
        return view('blog::create_blog', compact('data'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => "required|string|unique:infix_blog_category|max:50",
        ]);

        $blog_category = new InfixBlogCategory;
        $blog_category->name = $request->name;
        // $blog_category->status = $request->status;
        // $blog_category->save();


        $result = $blog_category->save();

        $data['blog_categories'] = InfixBlogCategory::get();


        if ($result) {
            Toastr::success('Succsesfully Category Added !', 'Success');
            return redirect()->route('categoryList');
        } else {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('categoryList');
        }
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function editCategory($id)
    {
        $data['blog_categories'] = InfixBlogCategory::get();
        $data['edit'] = InfixBlogCategory::find($id);
        return view('blog::blog_category',  compact('data'));
    }
    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:50",
            'status' => "required",

        ]);

        $blog_category = InfixBlogCategory::find($request->id);
        $blog_category->name = $request->name;
        $blog_category->status = $request->status;
        // $blog_category->update();


        $result = $blog_category->save();

        $data['blog_categories'] = InfixBlogCategory::get();


        if ($result) {
            Toastr::success('Succsesfully Category Updated !', 'Success');
            return redirect()->route('categoryList');
        } else {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('categoryList');
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
            $infix_blogs = InfixBlog::where('blog_category_id', '=', $id)->get();

            foreach ($infix_blogs as $infix_blog) {
                $single_blog = InfixBlog::destroy($infix_blog->id);
            }

            $result = InfixBlogCategory::destroy($id);
            if ($result) {
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            Toastr::error('This category used in blog', 'Failed');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function blogList()
    {
        $data['blog'] = InfixBlog::join('infix_blog_category', 'infix_blog.blog_category_id', '=', 'infix_blog_category.id')
            ->join('users', 'infix_blog.user_id', '=', 'users.id')
            ->select('infix_blog.id', 'title', 'description', 'tags', 'photo', 'name as category_name', 'username', 'infix_blog.status')
            ->get();
        // return $data['blog'];
        return view('blog::index', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function blogStore(Request $request)
    {
        //rashed
        $request->validate([
            'title' => "required|max:100",
            'description' => "required|max:1000",
            'category' => "required",
            'tags' => "required|max:100"
        ]);
        $blog = new InfixBlog;
        $blog->title = $request->title;
        $blog->user_id =  Auth::user()->id;
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->tags = $request->tags;

        if (empty($request->photo)) {
            $result = $blog->save();
        } else {
            $photo = "";
            if ($request->file('photo') != "") {
                $file = $request->file('photo');
                $photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                if (!file_exists('public/uploads/blog')) {
                    mkdir('public/uploads/blog', 0777, true);
                }
                $file->move('public/uploads/blog/', $photo);
                $photo = 'public/uploads/blog/' . $photo;
            }
            $blog->photo = $photo;
            $result = $blog->save();
        }
        $result = $blog->save();

        if ($result) {
            Toastr::success('Blog Created Succsesfully!', 'Success');
            return redirect()->route('blogList');
        } else {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('blogList');
        }
    }
    public function blogUpdate(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => "required|max:100",
            'description' => "required|max:1000",
            'category' => "required",
            'tags' => "required|max:100"

        ]);

        $blog =  InfixBlog::find($request->id);
        $blog->title = $request->title;
        $blog->user_id =  Auth::user()->id;
        $blog->description = $request->description;
        $blog->blog_category_id = $request->category;
        $blog->tags = $request->tags;
        $blog->status = $request->status;

        if (empty($request->photo)) {
            $result = $blog->save();
        } else {
            $photo = "";
            if ($request->file('photo') != "") {
                $file = $request->file('photo');
                $photo = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();

                if (!file_exists('public/uploads/blog')) {
                    mkdir('public/uploads/blog', 0777, true);
                }
                $file->move('public/uploads/blog/', $photo);
                $photo = 'public/uploads/blog/' . $photo;
            }
            $blog->photo = $photo;
            $result = $blog->save();
        }

        $result = $blog->save();

        if ($result) {
            Toastr::success('Blog Updated Succsesfully!', 'Success');
            return redirect()->route('blogList');
        } else {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('blogList');
        }
    }







    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function blogEdit($id)
    {

        $data['edit']  = InfixBlog::find($id);
        $data['categories'] = InfixBlogCategory::get();


        return view('blog::update_blog', compact('data'));
    }


    public function blogDelete($id)
    {
        $blog = InfixBlog::find($id);
        $result = $blog->delete();

        // $data['blog_categories'] = InfixBlogCategory::get();
        if ($result) {
            Toastr::success('Succsesfully Blog Deleted !', 'Success');
            return redirect()->route('blogList');
        } else {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->route('blogList');
        }
    }
}
