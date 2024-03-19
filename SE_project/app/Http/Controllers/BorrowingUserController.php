<?php

namespace App\Http\Controllers;
use App\Models\Durable;
use App\Models\Borrowing;
use App\Models\Borrowing_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingUserController extends Controller
{
    public function index()
    {
        $durables = Durable::where('availability_status', 'พร้อมใช้งาน')->get();;
        return view('borrowing.index_user', compact('durables'));
    }
    public function confirm(Request $request)
    {
        $request->validate([
            'durable_articles_id' => 'required|array|min:1',
        ],);
        $user = Auth::user();
        $selectedDurableIds = $request->input('durable_articles_id');
        $selectedDurables = Durable::whereIn('durable_articles_id', $selectedDurableIds)->get();
        return view('borrowing.confirm_user', compact('selectedDurables','user'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'borrowing_note' => 'required|string|max:255',
        ]);
        $user = Auth::user();
        $borrowing = new Borrowing();
        $borrowing->borrow_date = now();
        $borrowing->borrowing_note = $request->input('borrowing_note');
        $borrowing->status = 'ปกติ';
        $borrowing->id_sender = $user->id;
        $borrowing->save();
        $selectedDurableIds = $request->input('durable_articles_id');
        foreach ($selectedDurableIds as $durableId) {
            $durable = Durable::findOrFail($durableId);
            $durable->availability_status = 'ไม่พร้อมใช้งาน';
            $durable->save();
            $borrowingList = new Borrowing_list();
            $borrowingList->borrowing_id = $borrowing->borrowing_id;
            $borrowingList->durable_articles_id = $durableId;
            $borrowingList->status_approved = 'รอการอนุมัติ';
            $borrowingList->save();
        }
        return redirect()->route('borrowing.index_user')->with('success', 'Borrowing successful!');
    }

    public function index_history()
    {
        return view('borrowing.history');
    }

    public function considering()
    {
        $user = Auth::user();
        $borrowings = Borrowing::where('id_sender', $user->id)->where('status','รอการพิจารณา')->get();
        return view('borrowing.history_considering',compact('user','borrowings'));
    }

    public function considered()
    {
        $user = Auth::user();
        $borrowings = DB::table('borrowing')
                        ->join('users as sender', 'borrowing.id_sender', '=', 'sender.id')
                        ->join('users as approver', 'borrowing.id_approver', '=', 'approver.id')
                        ->join('users as checker', 'borrowing.id_checker', '=', 'checker.id')
                        ->select(
                            'borrowing.*', 
                            'sender.name as sender_name',
                            'approver.name as approver_name',
                            'checker.name as checker_name'
                        )
                        ->where('borrowing.id_sender', $user->id)
                        ->where('borrowing.status', 'พิจารณาแล้ว')
                        ->get();

        return view('borrowing.history_considered',compact('user','borrowings'));
    }

    public function detail(Request $request)
    {
        $borrowingId = $request->id;
        $borrowings = DB::table('borrowing')
                        ->join('users as sender', 'borrowing.id_sender', '=', 'sender.id')
                        ->join('users as approver', 'borrowing.id_approver', '=', 'approver.id')
                        ->join('users as checker', 'borrowing.id_checker', '=', 'checker.id')
                        ->join('borrowing_list', 'borrowing.borrowing_id', '=', 'borrowing_list.borrowing_id')
                        ->join('durable_articles as da', 'borrowing_list.durable_articles_id', '=', 'da.durable_articles_id')
                        ->select(
                            'borrowing.*', 
                            'sender.name as sender_name',
                            'approver.name as approver_name',
                            'checker.name as checker_name'
                        )
                        ->where('borrowing.borrowing_id', $borrowingId)
                        ->first();
        $borrowing_list = DB::table('borrowing_list')
                            ->join('durable_articles as da', 'borrowing_list.durable_articles_id', '=', 'da.durable_articles_id')
                            ->select(
                                'borrowing_list.*', 
                                'da.durable_articles_code as da_code',
                                'da.name as da_name'
                            )
                            ->where('borrowing_list.borrowing_id', $borrowingId)
                            ->get();
        return view('borrowing.history_detail', compact('borrowings','borrowing_list'));
    }
}
