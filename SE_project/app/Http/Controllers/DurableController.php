<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Durable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

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
            ->with('success', 'Deleted successfully');
    }
    public function edit(Request $request, $id){
        // $durable = Durable::findOrFail($id);
        $durable=\DB::table('durable_articles')->where('durable_articles_id', $id)->first();
        // $durable->edit($request->all());
        // \DB::table('durable_articles')->where('durable_articles_id', $id)->edit($request->all());
        // dd($durable);
        // return redirect()->route('durable.edit');
        return view('durable.edit', compact('durable'));
    }
    public function update(Request $request, $id){
        $request->validate(
            [
                'durable_articles_code'=>'required|max:5',
                'name'=>'required|max:30'
            ],
            [
                'durable_articles_code.required'=>'โปรดป้อนหมายเลขครุภัณฑ์',
                'durable_articles_code.max'=>'หมายเลขครุภัณฑ์ไม่ควรเกิน 5 ตัวอักษร',
                'name.required'=>'โปรดป้อนชื่อครุภัณฑ์',
                'name.max'=>'ชื่อครุภัณฑ์ไม่ควรเกิน 30 ตัวอักษร'
            ]
            );
            $data=[
                'durable_articles_code'=>$request->durable_articles_code,
                'name'=>$request->name
            ];
            DB::table('durable_articles')->where('durable_articles_id', $id)->update($data);
            return redirect('/durable');
    }

}