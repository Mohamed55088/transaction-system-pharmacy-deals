<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Notifications\StockAlert;
use App\Events\ProductReachedLowStock;
use App\Models\Customer;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "dashboard";

        // $total_purchases = Purchase::where('expiry_date', '=', Carbon::now())->count();
        // $total_categories = Category::count();
        // $total_suppliers = Supplier::count();
        $total_sales = Sales::count();
        $total_product = Product::where('created_at', '=', Carbon::now())->count();
        $total_customer = Customer::count();
        $pieChart = app()->chartjs
            ->name('pieChart')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels([' اجمالي المنتجات ', ' اجمالي المستخدمين ', ' إجمالي المبيعات '])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#7bb13c'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB', '#7bb13c'],
                    'data' => [$total_product, $total_customer, $total_sales]
                ]
            ])
            ->options([]);

        $latest_sales = Sales::whereDate('created_at', '=', Carbon::now())->get();
        $today_sales = Sales::whereDate('created_at', '=', Carbon::now())->sum('total_price');
        return view(
            'dashboard',
            compact(
                'title',
                'pieChart',
                'latest_sales',
                'today_sales',
                'total_product'
                // 'total_categories'
            )
        );
    }
}
