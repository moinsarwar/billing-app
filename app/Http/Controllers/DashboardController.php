<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $categorySales = BillItem::join('products', 'bill_items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'categories.id as category_id',
                'categories.name as category_name',
                DB::raw('SUM(bill_items.total_amount) as total_sales')
            )
            ->whereMonth('bill_items.created_at', date('m'))
            ->whereYear('bill_items.created_at', date('Y'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
        $salesData = Bill::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as total_sales')
        )
            ->whereMonth('bills.created_at', date('m'))
            ->whereYear('bills.created_at', date('Y'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();
        $dates = $salesData->pluck('date');
        $totals = $salesData->pluck('total_sales');
        return view('dashboard', compact('dates', 'totals', 'categorySales'));
    }
}
