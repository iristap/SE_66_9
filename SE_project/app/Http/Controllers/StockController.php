<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Material;
use App\Models\Stocks_list;

class StockController extends Controller
{
    // แสดงรายการสินค้าใน Stock
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }
    
    
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        $stockLists = $stock->stockLists;
        return view('stocks.show', compact('stock', 'stockLists'));
    }

    
    public function create()
    {
        $materials = Material::all();
        return view('stocks.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $formData = $request->all();

        // คุณสามารถใช้ dd() เพื่อดูข้อมูลที่ถูกส่งมา
        // dd($formData);

        // $ids = $request->input('material_id');
        // foreach ($ids as $id) {
        //     echo "id:";
        //     echo $id . "<br>";
        // }
        // $materials = Material::all();
        // foreach ($materials as $material) {
        //     // echo "id:";
        //     // echo $material->material_id . "<br>";
        //     // echo "name:";
        //     // echo $material->name . "<br>";
        //     // echo "quantity:";
        //     // echo $material->amount . "<br>";
        //     // echo $formData['quantity'][$material->id] . "<br>";
        //     // echo $formData["material_id"][$material->name]. "<br>";
        // }
        // echo $formData["material_id"]["กระดาษ"]. "<br>";

       
    

    // หรือ
   
    
  

    if (array_sum($formData["material_id"]) === 0) {
        return redirect()->route('stocks.create')->with('error', 'Please select at least one material.');
    }
    // echo $formData['id'][1]. "<br>";
    // if($formData["material_id"] == 0) {
    //     return redirect()->route('stocks.create')->with('error', 'Please select at least one material.');
    // }

    $stock = Stock::create([
        'date_stock' => now(),
        'id_stocker' => auth()->id(),
    ]);

    $materials = Material::all();
    foreach ($materials as $material) {
        if($formData["material_id"][$material->name] > 0) {
            Stocks_list::create([
                'id_stock' => $stock->id,
                'material_id' => $material->material_id,
                'quantity' => $formData["material_id"][$material->name],
            ]);

            $material->amount += $formData["material_id"][$material->name];
            $material->where('material_id', $material->material_id)->update(['amount' => $material->amount]);
        }

    }


   
    


    // // // ส่งผลการดำเนินการกลับไปยังหน้ารายการ Stocks พร้อมกับข้อความแจ้งเตือน
    return redirect()->route('stocks.index')->with('success', 'Stock added successfully.');
}

    


}
