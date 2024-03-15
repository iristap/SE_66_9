<?php

namespace App\Http\Controllers;
use App\Models\Durable;
use App\Models\Borrowing;
use App\Models\Borrowing_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BorrowingUserController extends Controller
{
    public function index()
    {
        $durables = Durable::where('availability_status', 'ว่าง')->get();;
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
            $durable->availability_status = 'ไม่ว่าง';
            $durable->save();
            $borrowingList = new Borrowing_list();
            $borrowingList->borrowing_id = $borrowing->id;
            $borrowingList->durable_articles_id = $durableId;
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
        return view('borrowing.history_considering');
    }

    public function considered()
    {
        return view('borrowing.history_considered');
    }
}
