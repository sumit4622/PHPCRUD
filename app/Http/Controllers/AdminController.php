<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('is_admin', false)->get();
        return view('admin.dashboard', compact('users'));
    }

    public function destroy(User $AdminDashboard)
    {
        $AdminDashboard->delete();

        return redirect()->route('AdminDashboard.index')->with('sucess', 'user delete successfully');
    }

    public function show(User $AdminDashboard)
    {
        try {
            $view_product = Product::where('user_id', $AdminDashboard->id)->get();
            return view('admin.view', compact('view_product'));
        } catch (\Throwable $th) {
            return view('admin.view', compact('soory nothing is here.'));
        }
    }

    public function edit(Product $AdminDashboard)
    {
        return view('admin.edit', ['product' => $AdminDashboard]);
    }

    public function update(Request $request, Product $AdminDashboard)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads', 'public');
        }

        $AdminDashboard->update($data);

        return redirect()
            ->route('AdminDashboard.index') 
            ->with('success', 'Product updated successfully');
    }
}
