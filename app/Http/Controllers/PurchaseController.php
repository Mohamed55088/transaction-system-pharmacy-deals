<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Customer;
use App\Models\HasMoney;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\TotalMoney;
use Illuminate\Http\Request;
use App\Models\type_medicine;
use App\Models\UpdateValueCustomer;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "purchases";
        $hasmoney = HasMoney::all();

        return view('purchases', compact(['title', 'hasmoney']));
    }

    /**
     * Display a create page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Set the title
        $title = " اضافة قيمة جديده ";

        // Fetch categories, suppliers, and type of medicines using Eloquent relationships
        $customers = Customer::all();
        $typevalues = type_medicine::all();

        // Pass data to the view using compact()
        return view('add-purchase', compact('title', 'customers', 'typevalues'));

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
            'name' => 'required|max:200',
            'typevalue' => 'required',
            'value' => 'required',
            'month' => 'required|max:12',
        ]);

        HasMoney::create([
            'customer_id' => $request->name,
            'type_medicine_id' => $request->typevalue,
            'value' => $request->value,
            'month' => $request->month,
            'user_id' => Auth::id(),
        ]);
        $customer = Customer::find($request->name);

        if ($customer) {
            $totalMoney = $customer->totalmoney;

            if ($request->typevalue == 1) {
                $localMoney = $totalMoney ? $totalMoney->local : 0;
                $localMoney += $request->value;

                if ($totalMoney) {
                    $totalMoney->update([
                        'local' => $localMoney
                    ]);
                } else {
                    TotalMoney::create([
                        'customer_id' => $customer->id,
                        'local' => $localMoney
                    ]);
                }
            } elseif ($request->typevalue == 2) {
                $importedMoney = $totalMoney ? $totalMoney->imported : 0;
                $importedMoney += $request->value;

                if ($totalMoney) {
                    $totalMoney->update([
                        'imported' => $importedMoney
                    ]);
                } else {
                    TotalMoney::create([
                        'customer_id' => $customer->id,
                        'imported' => $importedMoney
                    ]);
                }
            }
        }

        $notifications = array(
            'message' => " تمت إضافة القيمه بنجاح ",
            'alert-type' => 'success',
        );
        return redirect()->route('purchases')->with($notifications);
    }

    /**
     * Display the specified resource.
     *@param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $title = "Edit Purchase";
        $purchase = HasMoney::find($id);
        $customers = Customer::get();
        $typevalues = type_medicine::all();
        return view(
            'edit-purchase',
            compact(
                'title',
                'purchase',
                'typevalues',
                'customers'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasMoney $purchase)
    {
        $this->validate($request, [
            'name' => 'required|max:200',
            'value' => 'required',
            'month' => 'required|max:12',
            'typevalue' => 'required',
        ]);

        // Get the original values before the update
        $originalValues = $purchase->getOriginal();

        $purchase->update([
            'customer_id' => $purchase->customer->id,
            'value' => $request->value,
            'month' => $request->month,
            'type_medicine_id' => $request->typevalue,
            'user_id' => $request->user,
        ]);

        // Compare the original values with the updated values
        $changes = [];
        foreach ($originalValues as $key => $value) {
            if ($purchase->$key != $value) {
                $changes[$key] = [
                    'old' => $value,
                    'new' => $purchase->$key,
                ];
            }
        }

        // Check if there are any changes
        if (!empty($changes)) {
            UpdateValueCustomer::create([
                'user_id' => Auth::id(),
                'has_money_id' => $purchase->id,
                'value_update' => json_encode(['update' => ['before' => $originalValues, 'after' => $changes]]),
            ]);
        }

        $notification = [
            'message' => "تم التعديل بنجاح",
            'alert-type' => 'success',
        ];

        return redirect()->route('purchases')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $purchase = HasMoney::find($request->id);

        $customerId = $purchase->customer->id;
        $customer = Customer::find($customerId);

        $totalMoney = $customer->totalmoney;

        $typeMedicineId = $purchase->type_medicine_id;
        $value = $purchase->value;

        if ($typeMedicineId == 1) {
            $totalMoney->update([
                'local' => max(0, $totalMoney->local - $value)
            ]);
        } elseif ($typeMedicineId == 2) {
            $totalMoney->update([
                'imported' => max(0, $totalMoney->imported - $value)
            ]);
        }
        $purchase->delete();

        $notification = [
            'message' => " تم حذف القيمه بنجاح ",
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

}
