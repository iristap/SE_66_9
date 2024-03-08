<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Material;

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
        $request->validate([
            'materials' => 'required|array',
            'materials.*.material_id' => 'required|exists:materials,id',
            'materials.*.quantity' => 'required|numeric|min:1',
            // รายละเอียดอื่น ๆ ตามต้องการ
        ]);

        foreach ($request->materials as $material) {
            StockList::create([
                'material_id' => $material['material_id'],
                'quantity' => $material['quantity'],
                // เพิ่มรายละเอียดอื่น ๆ ตามต้องการ
            ]);
        }

        return redirect()->route('stocks.index')
                         ->with('success', 'Stock added successfully.');
    }
}
