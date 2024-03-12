<?php

namespace App\Http\Controllers;
use App\Models\Durable;
use App\Models\Borrowing_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $durables = Durable::where('status', 'ว่าง')->get();;
        return view('borrowing.index', compact('durables'));
    }
    public function confirm(Request $request)
    {
        $user = Auth::user();
        $selectedDurableIds = $request->input('durable_articles_id');
        $selectedDurables = Durable::whereIn('durable_articles_id', $selectedDurableIds)->get();
        return view('borrowing.confirm', compact('selectedDurables','user'));
    }
    public function store(Request $request)
    {
        return redirect()->route('borrowing.index');
    }
}
