<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Durable;
use Illuminate\Http\RedirectResponse;


class DurableController extends Controller
{
    function index()
    {
        $durable = Durable::getAll();
        return view('durable.index', compact('durable'));
    }
    // public function delete(Request $request)
    // {
    //     $id = $request->input('id');

    //     // Find the durable item by ID
    //     $durable = Durable::find($id);

    //     // Check if the durable item exists
    //     if ($durable) {
    //         // Delete the durable item
    //         $durable->delete();
    //         return redirect()->back()->with('success', 'Durable item deleted successfully.');
    //     } else {
    //         return redirect()->back()->with('error', 'Durable item not found.');
    //     }
    // }
    public function destroy($durable): RedirectResponse
    {
        Durable::where('durable_articles_id', $durable)->delete();
        return redirect()->route('durable.index')
            ->with('success', 'User deleted successfully');
    }

}