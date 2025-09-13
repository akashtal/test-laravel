<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerMaster;
use App\Models\ProductMaster;
use App\Models\PurchaseMaster;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $totalCustomers = CustomerMaster::where('created_by', auth()->id())->active()->count();
        $totalPurchases = PurchaseMaster::whereHas('customer', function($query) {
            $query->where('created_by', auth()->id());
        })->count();
        $totalValue = PurchaseMaster::whereHas('customer', function($query) {
            $query->where('created_by', auth()->id());
        })->sum('value');

        return view('employee.dashboard', compact('totalCustomers', 'totalPurchases', 'totalValue'));
    }

    public function customers()
    {
        $customers = CustomerMaster::where('created_by', auth()->id())->active()->paginate(10);
        return view('employee.customers', compact('customers'));
    }

    public function storeCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        CustomerMaster::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('employee.customers')
            ->with('success', 'Customer created successfully.');
    }

    public function editCustomer($id)
    {
        $customer = CustomerMaster::where('created_by', auth()->id())->findOrFail($id);
        return view('employee.edit_customer', compact('customer'));
    }

    public function updateCustomer(Request $request, $id)
    {
        $customer = CustomerMaster::where('created_by', auth()->id())->findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer->update($request->all());

        return redirect()->route('employee.customers')
            ->with('success', 'Customer updated successfully.');
    }

    public function deleteCustomer($id)
    {
        $customer = CustomerMaster::where('created_by', auth()->id())->findOrFail($id);
        $customer->update(['is_deleted' => true]);

        return redirect()->route('employee.customers')
            ->with('success', 'Customer deleted successfully.');
    }

    public function purchases()
    {
        $purchases = PurchaseMaster::whereHas('customer', function($query) {
            $query->where('created_by', auth()->id());
        })->with(['customer', 'product'])->paginate(10);
        
        return view('employee.purchases', compact('purchases'));
    }

    public function storePurchase(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customer_master,id',
            'product_id' => 'required|exists:product_master,id',
            'invoice_no' => 'required|string',
            'purchase_date' => 'required|date',
            'value' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verify that the customer belongs to the current employee
        $customer = CustomerMaster::where('created_by', auth()->id())
            ->findOrFail($request->customer_id);

        PurchaseMaster::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'invoice_no' => $request->invoice_no,
            'purchase_date' => $request->purchase_date,
            'value' => $request->value,
        ]);

        return redirect()->route('employee.purchases')
            ->with('success', 'Purchase created successfully.');
    }

    public function editPurchase($id)
    {
        $purchase = PurchaseMaster::whereHas('customer', function($query) {
            $query->where('created_by', auth()->id());
        })->with(['customer', 'product'])->findOrFail($id);
        
        $customers = CustomerMaster::where('created_by', auth()->id())->active()->get();
        $products = ProductMaster::all();
        
        return view('employee.edit_purchase', compact('purchase', 'customers', 'products'));
    }

    public function updatePurchase(Request $request, $id)
    {
        $purchase = PurchaseMaster::whereHas('customer', function($query) {
            $query->where('created_by', auth()->id());
        })->findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customer_master,id',
            'product_id' => 'required|exists:product_master,id',
            'invoice_no' => 'required|string',
            'purchase_date' => 'required|date',
            'value' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verify that the customer belongs to the current employee
        $customer = CustomerMaster::where('created_by', auth()->id())
            ->findOrFail($request->customer_id);

        $purchase->update($request->all());

        return redirect()->route('employee.purchases')
            ->with('success', 'Purchase updated successfully.');
    }

    public function deletePurchase($id)
    {
        $purchase = PurchaseMaster::whereHas('customer', function($query) {
            $query->where('created_by', auth()->id());
        })->findOrFail($id);
        
        $purchase->delete();

        return redirect()->route('employee.purchases')
            ->with('success', 'Purchase deleted successfully.');
    }
}
