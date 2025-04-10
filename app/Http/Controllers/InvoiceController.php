<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InvoiceController extends Controller
{
    public function productInvoice()
    {
        try {
            Log::info('Fetching all invoices');
            $invoices = Bill::orderBy('created_at', 'desc')->get();
            $dailySales = Bill::whereDate('created_at', today())->sum('total_amount');

            return view('invoice.list', [
                'invoices' => $invoices,
                'dailySales' => $dailySales,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching invoices: ' . $e->getMessage());
            return back()->with('error', 'Failed to fetch invoices.');
        }
    }

    public function show($id)
    {
        try {
            Log::info("Fetching invoice details for ID: $id");
            $bill = Bill::findOrFail($id);
            $billItems = BillItem::where('bill_id', $bill->id)->get();

            return view('invoice.show', [
                'bill' => $bill,
                'billItems' => $billItems,
            ]);
        } catch (\Exception $e) {
            Log::error("Error fetching invoice details for ID: $id - " . $e->getMessage());
            return back()->with('error', 'Failed to fetch invoice details.');
        }
    }

    public function destroy($id)
    {
        try {
            Log::info("Deleting invoice ID: $id");
            $bill = Bill::find($id);

            if (!$bill) {
                Log::warning("Invoice ID: $id not found.");
                return back()->with('error', 'Invoice not found.');
            }

            $billItem = BillItem::where('bill_id', $bill->id)->first();
            if ($billItem) {
                Log::info("Deleting bill items for invoice ID: $id");
                $billItem->delete();
            }

            $bill->delete();
            Log::info("Invoice ID: $id deleted successfully");

            return redirect(route('productInvoices'))->with('success', 'Invoice deleted successfully.');
        } catch (\Exception $e) {
            Log::error("Error deleting invoice ID: $id - " . $e->getMessage());
            return back()->with('error', 'Failed to delete invoice.');
        }
    }
}
