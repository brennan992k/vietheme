<?php

namespace Modules\Pages\Http\Controllers;

use App\Models\LicenseFeature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Modules\Pages\Entities\InfixFAQ;
use Modules\Pages\Entities\MarketApi;
use Modules\Pages\Entities\TicketPage;
use Modules\Pages\Entities\FrontCoupon;
use Modules\Pages\Entities\ItemSupport;
use Modules\Pages\Entities\LicensePage;
use Modules\Pages\Entities\BecomeAuthor;
use Modules\Pages\Entities\InfixHomePage;
use Modules\Pages\Entities\InfixAboutCompany;
use Modules\Pages\Entities\InfixPrivacyPolicy;
use Modules\Pages\Entities\InfixTermCondition;
use Modules\Pages\Entities\InfixProfileSetting;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        try {
            return view('pages::index');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function privacyPolicy()
    {
        try {
            $editData = InfixPrivacyPolicy::find(1);
            return view('pages::privacyPolicy', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function privacyPolicyUpdate(Request $request)
    {
        $request->validate([
            'heading_title' => 'required|min:3|max:1000',
            'sub_title' => 'required|min:3|max:1000',
            'short_description' => 'required|min:3|max:2000',
            'description' => 'required',
            'photo' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);


        try {
            $imagename = "";
            if ($request->file('photo') != "") {
                $file = $request->file('photo');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                if (!file_exists('public/Modules/Pages/Assets/img')) {
                    mkdir('public/Modules/Pages/Assets/img', 0777, true);
                }
                $file->move('public/Modules/Pages/Assets/img/', $image);
                $imagename = 'public/Modules/Pages/Assets/img/' . $image;
            }


            $editData = InfixPrivacyPolicy::find(1);
            $editData->heading_title = $request->heading_title;
            $editData->sub_title = $request->sub_title;
            $editData->short_description = $request->short_description;
            $editData->description = $request->description;
            $editData->image = $imagename;
            $results = $editData->save();


            if ($results) {
                Toastr::success('Succsesfully Category Added !', 'Success');
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

    public function termsConditions()
    {
        try {
            $editData = InfixTermCondition::find(1);
            return view('pages::termsConditions', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function termsConditionsUpdate(Request $request)
    {
        $request->validate([
            'heading_title' => 'required|min:3|max:1000',
            'sub_title' => 'required|min:3|max:1000',
            'short_description' => 'required|min:3|max:2000',
            'description' => 'required',
            'photo' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);


        try {
            $imagename = "";
            if ($request->file('photo') != "") {
                $file = $request->file('photo');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                if (!file_exists('public/Modules/Pages/Assets/img')) {
                    mkdir('public/Modules/Pages/Assets/img', 0777, true);
                }
                $file->move('public/Modules/Pages/Assets/img/', $image);
                $imagename = 'public/Modules/Pages/Assets/img/' . $image;
            }

            $editData = InfixTermCondition::find(1);
            $editData->heading_title = $request->heading_title;
            $editData->sub_title = $request->sub_title;
            $editData->short_description = $request->short_description;
            $editData->description = $request->description;
            $editData->image = $imagename;
            $results = $editData->save();

            if ($results) {
                Toastr::success('Term & Condition Updated Succsesfully!', 'Success');
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


    public function aboutCompany()
    {
        try {
            $editData = InfixAboutCompany::find(1);
            return view('pages::aboutCompany', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function aboutCompanyUpdate(Request $request)
    {
        $request->validate([
            'heading_title' => 'required|min:3|max:1000',
            'sub_title' => 'required|min:3|max:1000',
            'short_description' => 'required|min:3|max:2000',
            'description' => 'required',
            'photo' => 'sometimes|nullable|mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);


        try {

            $imagename = "";
            if ($request->file('photo') != "") {
                $file = $request->file('photo');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                if (!file_exists('public/Modules/Pages/Assets/img')) {
                    mkdir('public/Modules/Pages/Assets/img', 0777, true);
                }
                $file->move('public/Modules/Pages/Assets/img/', $image);
                $imagename = 'public/Modules/Pages/Assets/img/' . $image;
            }

            $editData = InfixAboutCompany::find(1);
            $editData->heading_title = $request->heading_title;
            $editData->sub_title = $request->sub_title;
            $editData->short_description = $request->short_description;
            $editData->description = $request->description;
            $editData->image = $imagename;
            $results = $editData->save();


            if ($results) {
                Toastr::success('Succsesfully Updated !', 'Success');
                return redirect()->route('about-company');
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

    public function faqs()
    {
        try {
            $data = InfixFAQ::all();
            return view('pages::faqs', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }


    public function faqs_edit($id)
    {

        try {
            $editData = InfixFAQ::find($id);
            $data = InfixFAQ::all();
            return view('pages::faqs', compact('data', 'editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    // faqs_store
    public function faqs_store(Request $request)
    {
        $request->validate([
            'question_title' => 'required|min:3|max:1000',
            'question_answer' => 'required|min:3|max:2000'
        ]);

        try {
            $s = new InfixFAQ();
            $s->question_title = $request->question_title;
            $s->question_answer = $request->question_answer;
            $s->active_status = 1;
            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
                return redirect()->route('faqs');
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



    // faqs_store
    public function faqs_update(Request $request)
    {
        $request->validate([
            'question_title' => 'required|min:3|max:1000',
            'question_answer' => 'required|min:3|max:2000'
        ]);

        try {
            $s = InfixFAQ::find($request->id);
            $s->question_title = $request->question_title;
            $s->question_answer = $request->question_answer;
            $s->active_status = 1;
            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
                return redirect()->route('faqs');
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
    public function faqs_delete($id)
    {
        try {
            $results = InfixFAQ::find($id)->delete();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
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
    // home page
    public function HomePage()
    {

        try {
            $editData = InfixHomePage::first();
            return view('pages::homePage', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function home_page_update(Request $request)
    {
        $request->validate([
            'homepage_title' => 'required|max:250',
            'homepage_description' => 'required',
            'feature_title' => 'required|max:250',
            'feature_title_description' => 'required',
            'product_title' => 'required|max:250',
            'product_title_description' => 'required',
            'banner_image' => "sometimes|nullable|mimes:jpeg,png,jpg",
        ]);


        try {


            $s = InfixHomePage::find($request->id);
            $s->homepage_title = $request->homepage_title;
            $s->homepage_description = $request->homepage_description;
            $s->feature_title = $request->feature_title;
            $s->feature_title_description = $request->feature_title_description;
            $s->product_title = $request->product_title;
            $s->product_title_description = $request->product_title_description;
            $image = "";
            if ($request->file('banner_image') != "") {
                $file = $request->file('banner_image');
                $image = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/img/banner/', $image);
                $image = 'public/uploads/img/banner/' . $image;
                $s->banner_image = $image;
            }
            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
                return redirect()->route('HomePage');
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
    // Coupon pages
    public function coupon_text()
    {

        try {
            $editData = FrontCoupon::first();
            return view('pages::coupon', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function coupon_text_update(Request $request)
    {
        $request->validate([
            'coupon' => 'required',
            'add_coupon' => 'required',
            'delete_coupon' => 'required',
            'expired_coupon' => 'required',
        ]);


        try {
            $s = FrontCoupon::find($request->id);
            $s->coupon = $request->coupon;
            $s->add_coupon = $request->add_coupon;
            $s->delete_coupon = $request->delete_coupon;
            $s->expired_coupon = $request->expired_coupon;
            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
                return redirect()->route('couponText');
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




    // Market Apis

    public function marketApis()
    {
        try {
            $editData = MarketApi::find(1);
            return view('pages::marketApis', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function marketApisUpdate(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);


        try {
            $editData = MarketApi::find(1);
            $editData->description = $request->description;
            $results = $editData->save();

            if ($results) {
                Toastr::success('Succsesfully Updated !', 'Success');
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




    //BecomeAuthor
    public function becomeAuthor()
    {

        try {

            $editData = BecomeAuthor::first();
            return view('pages::become_author', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function becomeAuthorUpdate(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);
        try {
            $editData = BecomeAuthor::first();
            // if ($editData==null) {
            // $editData=new BecomeAuthor();
            // }
            $editData->description = $request->description;
            $editData->save();
            Toastr::success('Updated Succsesfully!', 'Success');
            return redirect()->back();
        } catch (Throwable $th) {
            Toastr::error('Something went wrong ! try again ', 'Success');
            return redirect()->back();
        }
    }

    //Item Support

    public function itemSupport()
    {

        try {

            $editData = ItemSupport::find(1);
            // return $editData;
            return view('pages::itemSupport', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function itemSupportUpdate(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'sort_description' => 'required',
            'long_description' => 'required',
        ]);


        try {
            $editData = ItemSupport::find(1);

            $editData->description = $request->description;
            $editData->sort_description = $request->sort_description;
            $editData->long_description = $request->long_description;
            $results = $editData->save();

            if ($results) {
                Toastr::success('Item support updated !', 'Success');
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

    // License pages
    public function LicensePage()
    {


        try {

            $editData1 = LicensePage::first();
            $data = LicenseFeature::where('active_status', 1)->get();
            return view('pages::license_page', compact('editData1', 'data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function LicensePageUpdate(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'heading_text' => 'required',
            'heading2' => 'required',
            'heading2_text' => 'required',
        ]);


        try {

            $s = LicensePage::find($request->id);
            $s->heading = $request->heading;
            $s->heading_text = $request->heading_text;
            $s->heading2 = $request->heading2;
            $s->heading2_text = $request->heading2_text;
            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
                return redirect()->route('LicensePage');
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

    // Ticket pages
    public function TicketPage()
    {

        try {
            $editData = TicketPage::first();
            return view('pages::ticket_page', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function TicketPageUpdate(Request $request)
    {
        $request->validate([
            'ticket_text' => 'required',
            'heading' => 'required',
        ]);


        try {
            $s = TicketPage::find($request->id);
            $s->ticket_text = $request->ticket_text;
            $s->heading = $request->heading;

            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
                return redirect()->route('TicketPage');
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


    // Profile Settings
    public function ProfileSetting()
    {

        try {
            $editData = InfixProfileSetting::first();
            return view('pages::profile_setting_page', compact('editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }




    public function ProfileSettingUpdate(Request $request)
    {
        $request->validate([
            'heading1' => 'required|max:150',
            'text1' => 'required',
            'heading2' => 'required|max:150',
            'text2' => 'required',
            'heading3' => 'required|max:150',
            'text3' => 'required',
        ]);


        try {
            $s = InfixProfileSetting::find($request->id);
            $s->heading1 = $request->heading1;
            $s->text1 = $request->text1;
            $s->heading2 = $request->heading2;
            $s->text2 = $request->text2;
            $s->heading3 = $request->heading3;
            $s->text3 = $request->text3;

            $results = $s->save();
            if ($results) {
                Toastr::success('Operation Success', 'Success');
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
}
