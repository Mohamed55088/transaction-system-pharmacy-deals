<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Events\PurchaseOutStock;
use App\Models\Customer;
use App\Models\UpdateSalesCustomer;
use App\Notifications\StockAlert;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "sales";
        $products = Product::all();
        $customers = Customer::all();
        $sales = Sales::all();

        return view(
            'sales',
            compact(
                'title',
                'products',
                'sales',
                'customers'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'productid' => 'required',
            'customerid' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        // Retrieve product and customer
        $product = Product::find($request->productid);
        $customer = Customer::find($request->customerid);
        $totalPrice = $product->price * $request->quantity;
        $totalMoney = $customer->totalmoney;
        $notification = '';
        // Check if the product is local or imported

        if ($product->type->name == " محلي ") {
            // Deduct from local balance if available, else deduct from imported
            $balanceToDeduct = !empty($totalMoney->local) ? 'local' : 'imported';
            if ($totalMoney->$balanceToDeduct >= $totalPrice) {
                $totalMoney->update([
                    $balanceToDeduct => $totalMoney->$balanceToDeduct - $totalPrice
                ]);
            } else {
                $notification = array(
                    'message' => "عذراً الرصيد الموجود غير كافي",
                    'alert-type' => 'danger',
                );
            }
        } elseif ($product->type->name == " مستورد ") {
            // Deduct from imported balance if available, else check local balance with a 15% surcharge
            if (!empty($totalMoney->imported) && $totalMoney->imported >= $totalPrice) {
                $totalMoney->update([
                    'imported' => $totalMoney->imported - $totalPrice
                ]);
            } elseif ($totalMoney->local > 0 && $totalMoney->local >= ($totalPrice + ($totalPrice * 15 / 100))) {
                $totalMoney->update([
                    'local' => $totalMoney->local - ($totalPrice + ($totalPrice * 15 / 100))
                ]);
            } else {
                $notification = array(
                    'message' => "عذراً الرصيد الموجود غير كافي",
                    'alert-type' => 'danger',
                );

                return back()->with($notification);
            }
        }

        // Create a new sales record
        Sales::create([
            'product_id' => $request->productid,
            'quantity' => $request->quantity,
            'customer_id' => $request->customerid,
            'total_price' => $totalPrice,
            'user_id' => Auth::id(),
        ]);

        // Update quantity of sold item from purchases (if needed)

        $notification = array(
            'message' => "تم بيع المنتج بنجاح",
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'product' => 'required',
            'quantity' => 'required|integer'
        ]);

        $product = Product::find($request->product);
        $sale = Sales::where('id', $request->id)->first();
        $customer = $sale->customer;
        $totalPrice = $product->price * $request->quantity;
        $totaOldPrice = $sale->quantity * $sale->product->price;
        $totalMoney = $customer->totalmoney;
        $notification = '';

        // Check if the product is local or imported
        if ($product->type->name == " محلي ") {
            // Deduct from local balance if available, else deduct from imported
            $balanceToDeduct = $totalMoney->local + $totaOldPrice >= $totalPrice ? 'local' : 'imported';
            $totalHaveMoney = $totalMoney->$balanceToDeduct + $totaOldPrice;
            if ($totalHaveMoney >= $totalPrice) {
                $totalMoney->update([
                    $balanceToDeduct => $totalHaveMoney - $totalPrice
                ]);
            } else {
                $notification = array(
                    'message' => "عذراً الرصيد الموجود غير كافي",
                    'alert-type' => 'danger',
                );
                return back()->with($notification);
            }
        } elseif ($product->type->name == " مستورد ") {
            // Deduct from imported balance if available, else check local balance with a 15% surcharge
            if (!empty($totalMoney->imported) && $totalMoney->imported >= $totalPrice) {
                $totalMoney->update([
                    'imported' => ($totalMoney->imported + $totaOldPrice) - $totalPrice
                ]);
            } elseif ($totalMoney->local > 0 && $totalMoney->local >= ($totalPrice + ($totalPrice * 15 / 100))) {
                $totalMoney->update([
                    'local' => ($totalMoney->local + $totaOldPrice) - ($totalPrice + ($totalPrice * 15 / 100))
                ]);
            } else {
                $notification = array(
                    'message' => "عذراً الرصيد الموجود غير كافي",
                    'alert-type' => 'danger',
                );

                return back()->with($notification);
            }
        }
        $originalValues = $sale->getOriginal();
        // Update record
        $sale->update([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'customer_id' => $customer->id,
            'total_price' => $totalPrice,
            'user_id' => $sale->user_id,
        ]);

        // Calculate updated values
        $updatedValues = [
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'customer_id' => $customer->id,
            'total_price' => $totalPrice,
            'user_id' => $sale->user_id,
        ];

        // Update quantity of sold item from purchases (if needed)
        UpdateSalesCustomer::create([
            'sale_id' => $sale->id,
            'user_id' => Auth::id(),
            'value_update' => json_encode(['update' => ['before' => $originalValues, 'after' => $updatedValues]]),
        ]);

        $notification = array(
            'message' => "تم تحديث المنتج بنجاح",
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sale = Sales::find($request->id);
        $customer = $sale->customer;
        $type = $sale->product->type->name ? 'local' : 'imported';
        $totalMoney = $customer->$type += $sale->total_price;
        $customer->totalmoney->update([$type => $totalMoney]);
        $sale->delete();
        $notification = array(
            'message' => "Sales has been deleted",
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
