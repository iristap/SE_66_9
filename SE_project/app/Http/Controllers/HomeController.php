<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Disbursement;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $borrowings = Borrowing::selectRaw('MONTH(approved_date) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->whereNotNull('approved_date')
                            ->get();

        $disbursements = Disbursement::selectRaw('MONTH(date_approved) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->whereNotNull('date_approved')
                            ->get();
        return view('home', compact('borrowings', 'disbursements'));
    }
}
