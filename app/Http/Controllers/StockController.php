<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockLog;
use Illuminate\Http\Request;

class StockController extends Controller
{
    // 🔹 1. Add Stock Form
    public function addForm()
    {
        return view('stock.add');
    }

    // 🔹 2. Store New Stock
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = Stock::create([
            'item_name' => $request->item_name,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);

        StockLog::create([
            'stock_id' => $stock->id,
            'type' => 'add',
            'amount' => $request->quantity,
            'remarks' => 'Initial stock added',
        ]);

        return redirect()->route('dashboard')->with('success', 'Stock added successfully!');
    }

    // 🔹 3. Reduce Stock Form
    public function reduceForm()
    {
        $stocks = Stock::all();
        return view('stock.reduce', compact('stocks'));
    }

    // 🔹 4. Reduce Stock
   public function reduce(Request $request)
{
    $request->validate([
        'stock_id' => 'required|exists:stocks,id',
        'amount' => 'required|integer|min:1',
        'remarks' => 'nullable|string',
    ]);

    $stock = Stock::findOrFail($request->stock_id);

    // ✅ Check: Not allow reducing more than available
    if ($request->amount > $stock->quantity) {
        return back()->withErrors(['amount' => 'You cannot reduce more than available stock ('.$stock->quantity.')'])->withInput();
    }

    $stock->quantity -= $request->amount;
    $stock->save();

    StockLog::create([
        'stock_id' => $stock->id,
        'type' => 'reduce',
        'amount' => $request->amount,
        'remarks' => $request->remarks ?? 'Stock reduced',
    ]);

    return redirect()->route('dashboard')->with('success', 'Stock reduced successfully!');
}

    // 🔹 5. Allot Stock Form
    public function allotForm()
    {
        $stocks = Stock::all();
        return view('stock.allot', compact('stocks'));
    }

    // 🔹 6. Allot Stock Temporarily
 public function allot(Request $request)
{
    $request->validate([
        'stock_id' => 'required|exists:stocks,id',
        'amount' => 'required|integer|min:1',
        'remarks' => 'nullable|string',
    ]);

    $stock = Stock::findOrFail($request->stock_id);

    // ✅ Check: Not allow allotting more than available
    if ($request->amount > $stock->quantity) {
        return back()->withErrors(['amount' => 'You cannot allot more than available stock ('.$stock->quantity.')'])->withInput();
    }

    $stock->quantity -= $request->amount;
    $stock->save();

    StockLog::create([
        'stock_id' => $stock->id,
        'type' => 'allot',
        'amount' => $request->amount,
        'remarks' => $request->remarks ?? 'Stock allotted temporarily',
    ]);

    return redirect()->route('dashboard')->with('success', 'Stock allotted successfully!');
}


    // 🔹 7. Restock Form
    public function restockForm()
    {
        $stocks = Stock::all();
        return view('stock.restock', compact('stocks'));
    }

    // 🔹 8. Restock Item
    public function restock(Request $request)
    {
        $request->validate([
            'stock_id' => 'required|exists:stocks,id',
            'amount' => 'required|integer|min:1',
            'remarks' => 'nullable|string',
        ]);

        $stock = Stock::findOrFail($request->stock_id);
        $stock->quantity += $request->amount;
        $stock->save();

        StockLog::create([
            'stock_id' => $stock->id,
            'type' => 'restock',
            'amount' => $request->amount,
            'remarks' => $request->remarks ?? 'Restocked item',
        ]);

        return redirect()->route('dashboard')->with('success', 'Item restocked successfully!');

    }
    public function stockReport()
{
    $stocks = Stock::all();
    return view('stock.report', compact('stocks'));
}
public function stockHistory()
{
    $stocks = Stock::all();
    return view('stock.history', compact('stocks'));
}

public function stockHistoryDetail($id)
{
    $stock = Stock::findOrFail($id);
    $logs = $stock->logs()->where('type', 'allot')->latest()->get();
    return view('stock.history_detail', compact('stock', 'logs'));
}
public function returnStock(Request $request, $log_id)
{
    $log = StockLog::findOrFail($log_id);

    if ($log->type !== 'allot') {
        return back()->with('error', 'Only allotted stock can be returned.');
    }

    // ⛔ Add Null Check
    if (!$log->stock) {
        return back()->with('error', 'Related stock not found for this allotment.');
    }

    $request->validate([
        'return_amount' => 'required|integer|min:1|max:' . $log->amount,
    ]);

    $stock = $log->stock;
    $stock->quantity += $request->return_amount;
    $stock->save();

    StockLog::create([
        'stock_id' => $stock->id,
        'type' => 'return',
        'amount' => $request->return_amount,
        'remarks' => 'Returned from allotment ID: ' . $log->id,
    ]);

    return back()->with('success', 'Stock returned successfully!');
}
public function returnHistory()
{
    $logs = \App\Models\StockLog::with('stock')
        ->where('type', 'return')
        ->latest()
        ->get();

    return view('stock.return_history', compact('logs'));
}

}

