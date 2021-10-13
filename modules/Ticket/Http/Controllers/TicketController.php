<?php

namespace Modules\Ticket\Http\Controllers;

use App\Models\SmNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Entities\InfixTicket;
use Modules\HumanResource\Entities\InfixDepartment;
use Modules\Ticket\Entities\InfixTicketComment;
use Modules\Ticket\Entities\InfixTicketCategory;
use Modules\Ticket\Entities\InfixTicketPriority;
use Modules\Systemsetting\Entities\InfixEmailSetting;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function titcketStatus()
    {

        try {
            $itemCategories = InfixTicketCategory::all();
            $tickets = DB::table('infix_tickets')
                ->leftjoin('infix_ticket_categories', 'infix_ticket_categories.id', '=', 'infix_tickets.category_id')
                ->leftjoin('infix_ticket_priorities', 'infix_ticket_priorities.id', '=', 'infix_tickets.priority_id')
                ->leftjoin('users as u1', 'infix_tickets.user_id', '=', 'u1.id')
                ->leftjoin('users as u2', 'infix_tickets.author', '=', 'u2.id')
                ->select('infix_tickets.id', 'infix_ticket_categories.name as category_name', 'infix_ticket_priorities.name as priority_name', 'subject', 'description', 'u1.username as user', 'u2.username as author', 'infix_tickets.active_status', 'infix_tickets.user_id', 'infix_tickets.author as author_id')
                ->get();
            return view('ticket::backend.ticket_status', compact('itemCategories', 'tickets'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function category()
    {

        try {
            $itemCategories = InfixTicketCategory::all();
            return view('ticket::backend.category', compact('itemCategories'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function category_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:infix_ticket_categories'
        ]);
        try {
            $category = new InfixTicketCategory();
            $category->name = $request->name;
            $category->save();

            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicketcategory');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicketcategory');
        }
    }
    function category_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:infix_ticket_categories,name,' . $id
        ]);
        try {
            $category = InfixTicketCategory::findOrfail($id);
            $category->name = $request->name;
            $category->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicketcategory');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicketcategory');
        }
    }
    function category_edit($id)
    {
        try {
            $editData = InfixTicketCategory::findOrFail($id);
            $itemCategories = InfixTicketCategory::all();
            return view('ticket::backend.category', compact('itemCategories', 'editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function category_delete($id)
    {
        $tables = InfixTicket::where('category_id', $id)->first();
        // return $tables;
        try {
            if ($tables == null) {

                InfixTicketCategory::find($id)->delete();

                Toastr::success('Operation successful', 'Success');
                return redirect()->route('infixTicketcategory');
            } else {
                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    // priority
    function priority()
    {
        try {
            $itemCategories = InfixTicketPriority::all();
            return view('ticket::backend.priority', compact('itemCategories'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function priority_store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|unique:infix_ticket_priorities'
        ]);
        try {
            $priority = new InfixTicketPriority();
            $priority->name = $request->name;
            $priority->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicketPriority');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicketPriority');
        }
    }
    function priority_edit($id)
    {
        try {
            $editData = InfixTicketPriority::findOrFail($id);
            $itemCategories = InfixTicketPriority::all();
            return view('ticket::backend.priority', compact('itemCategories', 'editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function priority_update(Request $request, $id)
    {

        $request->validate([

            'name' => 'required|string|unique:infix_ticket_priorities,name,' . $id
        ]);
        try {
            $priority =  InfixTicketPriority::findOrfail($id);
            $priority->name = $request->name;
            $priority->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicketPriority');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicketPriority');
        }
    }

    function priority_delete($id)
    {
        $tables = InfixTicket::where('priority_id', $id)->first();
        // return $tables;
        try {
            if ($tables == null) {

                InfixTicketPriority::findOrfail($id)->delete();
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('infixTicketPriority');
            } else {
                $msg = 'This data already used in tables, Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function index()
    {
        try {
            $category = InfixTicketCategory::latest()->get();
            $priority = InfixTicketPriority::latest()->get();

            if (Auth::user()->role_id != 1) {
                $tickets = InfixTicket::where('user_agent', Auth::user()->id)->orWhere('created_by', Auth::user()->id)->orderBy('id', 'desc')->get();
            } else {

                $tickets = InfixTicket::orderBy('id', 'desc')->get();
            }
            $comment = InfixTicketComment::latest()->get();
            return view('ticket::backend.ticket', compact('category', 'priority', 'tickets', 'comment'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function add_ticket()
    {
        try {
            $user_agent = User::where('role_id', '!=', 4)->where('role_id', '!=', 5)->where('role_id', '!=', 3)->get();
            $category = InfixTicketCategory::latest()->get();
            $priority = InfixTicketPriority::latest()->get();
            $user = User::where('role_id', 5)->get();
            $authors = User::where('role_id', 4)->get();
            return view('ticket::backend.add_ticket', compact('category', 'priority', 'user', 'authors', 'user_agent'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function ticket_store(Request $request)
    {
        // return $request;
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string|max:1000',
            'category' => 'required',
            'priority' => 'required',
            'user_agent' => 'required',
            // 'active_status' => 'required',
            // 'author' => 'required',
            // 'user' => 'required',
        ]);
        // return $request;
        try {
            $ticket = new InfixTicket();
            $ticket->subject = $request->subject;
            $ticket->description = $request->description;
            $ticket->category_id = $request->category;
            $ticket->priority_id = $request->priority;
            $ticket->active_status = $request->active_status;
            $ticket->author = $request->author;
            $ticket->user_id = $request->user;
            $ticket->user_agent = $request->user_agent;
            $ticket->created_by = Auth::user()->id;
            $ticket->save();

            $notification = new SmNotification();
            $notification->user_id = $ticket->user_id;
            $notification->ticket_id = $ticket->id;
            $notification->role_id = $ticket->user->role_id;
            $notification->message = $ticket->assignee->username . ' assigned a ticket';
            $notification->link = route('infixTicket_view', $ticket->id);
            $notification->received_id = $request->user_agent;
            $notification->save();

            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicket_list');
        } catch (\Swift_TransportException $st) {
            Toastr::error('Email setup problem', 'Failed');
            return redirect()->route('infixTicket_list');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicket_list');
        }
    }
    public function ticket_edit($id)
    {
        try {
            $editData = InfixTicket::findOrfail($id);
            $category = InfixTicketCategory::latest()->get();
            $priority = InfixTicketPriority::latest()->get();
            $user_agent = User::where('role_id', '!=', 4)->where('role_id', '!=', 5)->where('role_id', '!=', 3)->get();
            $user = User::where('role_id', 5)->get();
            $authors = User::where('role_id', 4)->get();
            return view('ticket::backend.add_ticket', compact('category', 'priority', 'user', 'authors', 'editData', 'user_agent'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    public function ticket_update(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'description' => 'required|string|max:1000',
            'category' => 'required',
            'priority' => 'required',
            'active_status' => 'required',
        ]);


        DB::beginTransaction();
        try {
            $ticket = InfixTicket::findOrfail($request->id);
            $ticket->subject = $request->subject;
            $ticket->description = $request->description;
            $ticket->category_id = $request->category;
            $ticket->priority_id = $request->priority;
            $ticket->active_status = $request->active_status;
            $ticket->author = $request->author;
            if (@$request->user_agent) {
                $ticket->user_agent = $request->user_agent;
            }
            if (@$request->user) {
                $ticket->user_id = $request->user;
            }
            $ticket->updated_by = Auth::user()->id;
            $ticket->save();
            if ($request->user_agent) {
                $notification = new SmNotification();
                $notification->user_id = $ticket->user_id;
                $notification->ticket_id = $ticket->id;
                $notification->role_id = $ticket->user->role_id;
                $notification->message = $ticket->assignee->username . ' assigned a ticket';
                $notification->link = route('infixTicket_view', $ticket->id);
                $notification->received_id = $request->user_agent;
                $notification->save();
            }

            if (@$request->active_status != 0) {
                $notification = new SmNotification();
                $notification->user_id = $ticket->user_id;
                $notification->ticket_id = $ticket->id;
                $notification->role_id = $ticket->user->role_id;
                $notification->message = ($request->active_status == 1) ? $ticket->assignee->username . ' close this ticket' : $ticket->assignee->username . ' progress this ticket';
                $notification->link = route('infixTicket_view', $ticket->id);
                $notification->received_id = 1;
                $notification->save();

                $data = [
                    'username' => $ticket->user->username,
                    'email' => $ticket->user->email,
                    'url' => route('user.ticket_view', $ticket->id),
                    'title' => $ticket->subject,
                ];
                try {
                    // Mail::to($ticket->user->email)->send(new TicketMail($data));

                    $settings = InfixEmailSetting::first();
                    $reciver_email = $ticket->user->email;
                    $receiver_name =  $ticket->user->full_name;
                    $subject = $ticket->subject;
                    $view = "mail.ticket_mail";
                    $compact['data'] =  $data;
                    // return $compact;
                    @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    Log::info($msg);
                    Toastr::error($msg, 'Failed');
                }
            }

            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicket_list');
            // } catch (Exception $e) {
            //     Toastr::error('Operation Failed', 'Failed');
            //     return redirect()->route('infixTicket_list');
            // }
        } catch (\Swift_TransportException $st) {
            Toastr::error('Email setup problem', 'Failed');
            return redirect()->route('infixTicket_list');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicket_list');
        }
    }

    function ticket_delete_view($id)
    {
        try {
            InfixTicket::findOrfail($id)->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('infixTicket_list');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('infixTicket_list');
        }
    }
    public function infixTicket_view($id)
    {
        try {
            $status = InfixTicket::find($id);
            foreach ($status->notification as $key => $value) {
                $value->is_read = 1;
                $value->save();
            }
            $data = InfixTicket::findOrFail($id);
            $comment = InfixTicketComment::where('ticket_id', $data->id)->get();
            $allcom = InfixTicketComment::all();
            // return  $data;
            return view('ticket::backend.ticket_view', compact('data', 'comment', 'allcom'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    //Department

    public function showDepartment()
    {
        try {
            $departments = InfixDepartment::where('active_status', 1)->get();
            return view('ticket::backend.department', compact('departments'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    public function storeDepartment(Request $request)
    {
        $request->validate([
            'name' => "required"
        ]);

        try {

            $department = new InfixDepartment();
            $department->name = $request->name;
            $department->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('InfixDepartmentShow');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('InfixDepartmentShow');
        }
    }
    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'name' => "required"
        ]);

        try {
            $department = InfixDepartment::findOrfail($id);
            $department->name = $request->name;
            $department->save();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('InfixDepartmentShow');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('InfixDepartmentShow');
        }
    }
    public function editDepartment(Request $request, $id)
    {
        try {
            $department = InfixDepartment::find($id);
            $departments = InfixDepartment::all();
            return view('ticket::backend.department', compact('department', 'departments'));
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('InfixDepartmentShow');
        }
    }
    public function deleteDepartment(Request $request, $id)
    {
        try {
            $department = InfixDepartment::findOrfail($id);
            $department->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('InfixDepartmentShow');
        } catch (Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->route('InfixDepartmentShow');
        }
    }
    public function ticket_search(Request $res)
    {

        try {
            // return $res;
            // $app = InfixTicket::select('id', 'subject', 'user_id', 'category_id', 'assign_user', 'description', 'priority_id', 'active_status')
            //     ->orderBy('id', 'desc');
            // if ($res->category != null) {
            //     $app->where('category_id', 'like', '%' . $res->category . '%');
            // }
            // if ($res->priority != null) {
            //     $app->where('priority_id', 'like', '%' . $res->priority . '%');
            // }
            // if ($res->active_status != null) {
            //     $app->where('active_status', 'like', '%' . $res->active_status . '%');
            // }

            $category = InfixTicketCategory::latest()->get();
            $priority = InfixTicketPriority::latest()->get();
            $app = DB::table('infix_tickets')->leftjoin('infix_ticket_categories', 'infix_ticket_categories.id', '=', 'infix_tickets.category_id')
                ->leftjoin('infix_ticket_priorities', 'infix_ticket_priorities.id', '=', 'infix_tickets.priority_id')
                ->leftjoin('users as u1', 'infix_tickets.user_id', '=', 'u1.id')
                ->leftjoin('users as u2', 'infix_tickets.author', '=', 'u2.id')
                ->select('infix_tickets.id', 'infix_ticket_categories.name as category_name', 'infix_ticket_priorities.name as priority_name', 'subject', 'description', 'u1.username as user', 'u2.username as author', 'infix_tickets.active_status', 'infix_tickets.user_id', 'infix_tickets.author as author_id');
            if ($res->category != null) {
                $app->where('infix_tickets.category_id', 'like', '%' . $res->category . '%');
            }
            if ($res->priority != null) {
                $app->where('infix_tickets.priority_id', 'like', '%' . $res->priority . '%');
            }
            if ($res->active_status != null) {
                $app->where('infix_tickets.active_status', 'like', '%' . $res->active_status . '%');
            }
            $tickets = $app->get();
            return view('ticket::backend.ticket_search', compact('category', 'priority', 'tickets'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function comment_store(Request $r)
    {

        $r->validate([
            'comment' => 'required|string',
            'file'       => 'sometimes|required|mimes:doc,pdf,docx,jpg,jpeg,png',
        ]);
        DB::beginTransaction();
        try {
            $ticket = InfixTicket::findOrFail($r->id);
            if ($ticket) {
                $data = InfixTicketComment::create([
                    'user_id' => Auth::user()->id,
                    'client_id' => $ticket->user_id,
                    'ticket_id'   => $ticket->id,
                    'comment'   => $r->comment,
                    'file'  => null
                ]);
                $fileName = "";
                if ($r->file('file') != "") {
                    $file = $r->file('file');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $file->move('public/uploads/comment/', $fileName);
                    $data->file = 'public/uploads/comment/' . $fileName;
                    $data->save();
                }
                $data = [
                    'username' => $ticket->user->username,
                    'email' => $ticket->user->email,
                    'body' => $r->comment,
                    'url' => route('user.ticket_view', $ticket->id),
                    'title' => $ticket->subject,
                ];
                try {
                    // Mail::to($ticket->user->email)->send(new NotificationMail($data));

                    $settings = InfixEmailSetting::first();
                    $reciver_email = $ticket->user->email;
                    $receiver_name =  $ticket->user->full_name;
                    $subject = 'Ticket';
                    $view = "mail.notification_mail";
                    $compact['data'] =  $data;
                    @send_mail($reciver_email, $receiver_name, $subject, $view, $compact);
                } catch (Exception $e) {
                    $msg = $e->getMessage();
                    Log::info($msg);
                    Toastr::error($msg, 'Failed');
                }

                DB::commit();
                Toastr::success('Operation successful', 'Success');
                return redirect()->back();
            } else {
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Swift_TransportException $e) {
            Toastr::error('Failed to authenticate on SMTP server', 'Error');
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error('Something went wrong! please try again', 'Error');
            return redirect()->back();
        }
    }

    function comment_reply(Request $r)
    {
        $r->validate([
            'comment' => 'required|string',
            'file'       => 'sometimes|required|mimes:doc,pdf,docx,jpg,jpeg,png',
        ]);

        try {
            $comment = InfixTicketComment::find($r->comment_id);
            $data = InfixTicketComment::create([
                'user_id' => Auth::user()->id,
                'client_id' => $comment->client_id,
                'ticket_id'   => $comment->ticket_id,
                'comment'   => $r->comment,
                'comment_id'   => $r->comment_id,
                'file'  => null
            ]);
            $fileName = "";
            if ($r->file('file') != "") {
                $file = $r->file('file');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $file->move('public/uploads/comment/', $fileName);
                $data->file = 'public/uploads/comment/' . $fileName;
                $data->save();
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function ticket_show(Request $r, $id)
    {
        $status = InfixTicket::find($id);
        foreach ($status->notification as $key => $value) {
            $value->is_read = 1;
            $value->save();
        }
        return response()->json(['success' => 'success']);
    }
}
