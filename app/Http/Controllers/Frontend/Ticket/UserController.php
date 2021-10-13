<?php

namespace App\Http\Controllers\Frontend\Ticket;

use App\Models\User;
use App\Models\SmNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Entities\InfixTicket;
use Modules\Ticket\Entities\InfixTicketComment;
use Modules\Ticket\Entities\InfixTicketCategory;
use Modules\Ticket\Entities\InfixTicketPriority;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function add_ticket()
    {

        try {
            $data['ticket_category'] = InfixTicketCategory::latest()->get();
            $data['ticket_priority'] = InfixTicketPriority::latest()->get();
            return view('backend.user.add_ticket', compact('data'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function ticket_store(Request $r)
    {
        $this->validate($r, [
            'subject' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'priority_id' => 'required|integer',
            'department_id' => 'required|integer',
            'image'       => 'sometimes|nullable|mimes:doc,pdf,docx,jpg,jpeg,png',
        ]);
        DB::beginTransaction();
        try {
            $rcv = User::where('role_id', 1)->first();
            $ticket = new InfixTicket();
            $ticket->user_id = Auth::user()->id;
            $ticket->subject   = $r->subject;
            $ticket->description   = $r->description;
            $ticket->category_id   = $r->category_id;
            $ticket->priority_id   = $r->priority_id;
            $ticket->department_id   = $r->department_id;
            $ticket->save();

            $data = new SmNotification();
            $data->user_id = $ticket->user_id;
            $data->ticket_id = $ticket->id;
            $data->message = $ticket->user->username . ' created a ticket';
            $data->link = route('infixTicket_view', $ticket->id);
            $data->received_id = $rcv->id;
            $data->save();

            if ($r->file('image') != "") {
                $file = $r->file('image');
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $pathImage = 'public/uploads/comment/';
                if (!file_exists($pathImage)) {
                    mkdir($pathImage, 0777, true);
                    $file->move('public/uploads/comment/', $fileName);
                    $ticket->image = 'public/uploads/comment/' . $fileName;
                } else {
                    $file->move('public/uploads/comment/', $fileName);
                    $ticket->image = 'public/uploads/comment/' . $fileName;
                }
                $ticket->save();
            }
            DB::commit();
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function ticket_edit($id)
    {

        try {
            $editData = InfixTicket::findOrFail($id);
            $category = Category::latest()->get();
            $priority = Priority::latest()->get();
            return view('backend.user.add_ticket', compact('category', 'priority', 'editData'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function ticket_update(Request $r, $id)
    {
        $this->validate($r, [
            'subject' => 'required|string',
            'description' => 'required|string',
            'category' => 'required|integer',
            'priority' => 'required|integer'

        ]);

        try {
            Ticket::findOrFail($id)->update([
                'user_id' => Auth::user()->id,
                'subject'   => $r->subject,
                'description'   => $r->description,
                'category_id'   => $r->category,
                'priority_id'   => $r->priority,
            ]);
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('user.ticket');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function ticket_delete_view($id)
    {

        try {
            $url = route('user.ticket_delete', $id);
            return view('backend.tickets.modal', compact('url'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function ticket_delete($id)
    {

        try {
            Ticket::findOrFail($id)->delete();
            Toastr::success('Operation successful', 'Success');
            return redirect()->route('user.ticket');
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function ticket_view($id)
    {

        try {
            $data['ticket_category'] = InfixTicketCategory::latest()->get();
            $data['ticket_priority'] = InfixTicketPriority::latest()->get();
            $ticket = InfixTicket::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
            $viewTicket = InfixTicket::findOrFail($id);
            $comment = InfixTicketComment::where('client_id', Auth::user()->id)->where('ticket_id', $viewTicket->id)->get();
            return view('frontend.pages.support_ticket', compact('data', 'comment', 'ticket', 'viewTicket', 'comment'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function comment_store(Request $r)
    {
        $validator = $this->validate($r, [
            'comment' => 'required|string',
            'file'       => 'sometimes|nullable|mimes:doc,pdf,docx,jpg,jpeg,png',
        ]);
        DB::beginTransaction();
        try {
            $ticket = InfixTicket::findOrFail($r->id);
            if ($ticket) {
                $data = InfixTicketComment::create([
                    'user_id' => Auth::user()->id,
                    'client_id' => Auth::user()->id,
                    'ticket_id'   => $ticket->id,
                    'comment'   => $r->comment,
                    'file'  => null
                ]);

                if ($r->comment_id) {
                    $data->comment_id = $r->comment_id;
                    $data->save();
                }
                $fileName = "";
                if ($r->file('file') != "") {
                    $file = $r->file('file');
                    $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                    $pathImage = 'public/uploads/comment/';
                    if (!file_exists($pathImage)) {
                        mkdir($pathImage, 0777, true);
                        $file->move('public/uploads/comment/', $fileName);
                        $data->file = 'public/uploads/comment/' . $fileName;
                    } else {
                        $file->move('public/uploads/comment/', $fileName);
                        $data->file = 'public/uploads/comment/' . $fileName;
                    }
                    $data->save();
                }
                if ($data) {
                    $notific = new SmNotification();
                    $notific->user_id = $ticket->user_id;
                    $notific->ticket_id = $ticket->id;
                    $notific->message = $ticket->user->username . ' comment a ticket';
                    $notific->link = route('infixTicket_view', $ticket->id);
                    $notific->received_id = 1;
                    $notific->save();
                    if (@$ticket->user_agent && $ticket->user_agent != 1) {
                        $notific = new SmNotification();
                        $notific->user_id = $ticket->user_id;
                        $notific->ticket_id = $ticket->id;
                        $notific->message = $ticket->user->username . ' comment a ticket';
                        $notific->link = route('infixTicket_view', $ticket->id);
                        $notific->received_id = $ticket->user_agent;
                        $notific->save();
                    }
                }
                DB::commit();
                Toastr::success('Successfully comment added');
                return redirect()->back();
            } else {
                Toastr::error('Ticket not found antmore !', 'Error');
                return redirect()->back();
            }
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function reopen_ticket($id)
    {

        try {
            $ticket = Ticket::findOrFail($id);
            if ($ticket->active_status == 3) {

                $ticket->update([
                    'active_status' => 0
                ]);
                $data = new SmNotification();
                $data->user_id = Auth::user()->id;
                $data->ticket_id = $ticket->id;
                $data->role_id = Auth::user()->role_id;
                $data->message = $ticket->user->username . ' re open  this ticket';
                $data->link = route('admin.ticket_view', $ticket->id);
                $data->received_id = 1;
                $data->save();
                if ($ticket->assign_user) {
                    $data = new SmNotification();
                    $data->user_id = Auth::user()->id;
                    $data->ticket_id = $ticket->id;
                    $data->role_id = Auth::user()->role_id;
                    $data->message = $ticket->user->username . ' re open  this ticket';
                    $data->link = route('admin.ticket_view', $ticket->id);
                    $data->received_id = $ticket->assign_user;
                    $data->save();
                }
                Toastr::success('Ticket reopen !', 'Success');
                return redirect()->back();
            }
            Toastr::error('Ticket already open !', 'Failed');
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function active_ticket()
    {

        try {
            $ticket = Ticket::where('user_id', Auth::user()->id)->where('active_status', 0)->get();
            return view('backend.user.ticket-list', compact('ticket'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    function complete_ticket()
    {

        try {
            $ticket = Ticket::where('user_id', Auth::user()->id)->where('active_status', 1)->get();
            return view('backend.user.ticket-list', compact('ticket'));
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
    function comment_reply(Request $r)
    {
        $this->validate($r, [
            'comment' => 'required|string',
            'file'       => 'sometimes|required|mimes:doc,pdf,docx,jpg,jpeg,png',
        ]);

        try {
            $comment = Comment::find($r->comment_id);
            $data = Comment::create([
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
            $data = new SmNotification();
            $data->user_id = Auth::user()->id;
            $data->ticket_id = $comment->ticket_id;
            $data->role_id = Auth::user()->role_id;
            $data->message = Auth::user()->username . ' reply on your comment';
            $data->link = route('admin.ticket_view', $comment->ticket_id);
            $data->received_id = $comment->user_id;
            $data->save();
            return redirect()->back();
        } catch (Exception $e) {
            $msg = str_replace("'", " ", $e->getMessage());
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }
}
