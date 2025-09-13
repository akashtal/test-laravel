<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\UserMaster;
use App\Models\CustomerMaster;
use App\Models\ProductMaster;
use App\Models\PurchaseMaster;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalEmployees = UserMaster::where('role', 'Employee')->count();
        $totalCustomers = CustomerMaster::active()->count();
        $totalProducts = ProductMaster::count();
        $totalPurchases = PurchaseMaster::count();
        $totalValue = PurchaseMaster::sum('value');

        return view('admin.dashboard', compact(
            'totalEmployees', 
            'totalCustomers', 
            'totalProducts', 
            'totalPurchases', 
            'totalValue'
        ));
    }

    public function employees()
    {
        $employees = UserMaster::where('role', 'Employee')->paginate(10);
        return view('admin.employees', compact('employees'));
    }

    public function storeEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_master,username',
            'phone' => 'required|string|unique:user_master,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        UserMaster::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'Employee',
        ]);

        return redirect()->route('admin.employees')
            ->with('success', 'Employee created successfully.');
    }

    public function editEmployee($id)
    {
        $employee = UserMaster::findOrFail($id);
        return view('admin.edit_employee', compact('employee'));
    }

    public function updateEmployee(Request $request, $id)
    {
        $employee = UserMaster::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_master,username,' . $id,
            'phone' => 'required|string|unique:user_master,phone,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:Admin,Employee',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        return redirect()->route('admin.employees')
            ->with('success', 'Employee updated successfully.');
    }

    public function deleteEmployee($id)
    {
        $employee = UserMaster::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employees')
            ->with('success', 'Employee deleted successfully.');
    }

    public function customers()
    {
        $customers = CustomerMaster::with('creator')->active()->paginate(10);
        return view('admin.customers', compact('customers'));
    }

    public function products()
    {
        $products = ProductMaster::with('creator')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ProductMaster::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.products')
            ->with('success', 'Product created successfully.');
    }

    public function editProduct($id)
    {
        $product = ProductMaster::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = ProductMaster::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $product->update($request->all());

        return redirect()->route('admin.products')
            ->with('success', 'Product updated successfully.');
    }

    public function deleteProduct($id)
    {
        $product = ProductMaster::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')
            ->with('success', 'Product deleted successfully.');
    }

    public function purchases()
    {
        $purchases = PurchaseMaster::with(['customer', 'product', 'customer.creator'])
            ->paginate(10);
        return view('admin.purchases', compact('purchases'));
    }
}
