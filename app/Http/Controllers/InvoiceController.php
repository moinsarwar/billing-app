<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function productInvoice()
    {
        $invoices = Bill::orderBy('created_at', 'desc')->get();
        $dailySales = Bill::whereDate('created_at', today())->sum('total_amount');

        return view('invoice.list', [
            'invoices' => $invoices,
            'dailySales' => $dailySales,
        ]);
    }

    public function show($id)
    {
        $bill = Bill::findOrFail($id);
        $billItems = BillItem::where('bill_id', $bill->id)->get();

        return view('invoice.show', [
            'bill' => $bill,
            'billItems' => $billItems,
        ]);
    }
    public function destroy($id)
    {
        $bill = Bill::find($id);
        $billItem = BillItem::where('bill_id' , $bill->id)->first();
        if ($billItem){
        $billItem->delete();
        }
        $bill->delete();
        return redirect(route('productInvoices'));
    }
}
