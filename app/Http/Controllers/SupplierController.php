<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "العملاء";
        $customers = Customer::get();
        return view('suppliers', compact('title', 'customers'));
    }

    /**
     * Display a form for adding the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = " اضافة عميل ";
        return view(
            'add-supplier',
            compact(
                'title'
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|string',
            'phone' => ['max:13', 'regex:/^\+?\d{10,13}$/'], // Example regex pattern for phone number
            'address' => 'required|max:200',
            'description' => 'max:200',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->user_id = Auth::id();
        $customer->save();

        return redirect()->route('suppliers')->with([
            'success' => 'تمت إضافة المورد بنجاح.',
        ]);

    }


    /**
     * Display the specified resource.
     *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = "edit Supplier";
        $products = Product::get();
        $customer = Customer::find($id);
        return view(
            'edit-supplier',
            compact(
                'title',
                'products',
                'customer'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email|string',
            'phone' => ['max:13', 'regex:/^\+?\d{10,13}$/'], // Example regex pattern for phone number
            'address' => 'required|max:200',
            'description' => 'max:200',
        ]);

        $customer->update($request->all());
        $notification = array(
            'message' => "Supplier has been updated",
            'alert-type' => 'success',
        );
        return redirect()->route('suppliers')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $supplier = Customer::find($request->id);
        $supplier->delete();
        $notification = array(
            'message' => "تم حذف العميل بنجاح",
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }
    public function infoCustomer($id)
    {
        $title = "بيانات العميل";
        $customer = Customer::find($id);
        return view(
            'info-supplier',
            compact(
                'title',
                'customer'
            )
        );
    }
}
