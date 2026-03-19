<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateUserProfileRequest;
use App\Services\admin\AdminService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function index(Request $request)
    {
        try {
            //code...
            $users = User::where('is_admin', false)->get();

            return $this->success($users, 'User fetch Successfully', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'Server error', 500);
        }

        return view('admin.dashboard', compact('users'));
    }

    public function destroy(User $AdminDashboard)
    {
        try {
            //code...
            $deleteuser = $AdminDashboard->delete();
            return $this->success($deleteuser, 'User delete successfully', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'server Error', 500);
        }

        return redirect()->route('AdminDashboard.index')->with('sucess', 'user delete successfully');
    }

    public function show(User $AdminDashboard)
    {
        try {
            //code...
            $view_product = Product::where('user_id', $AdminDashboard->id)->get();

            return $this->success($view_product, 'Product review', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'Server error', 500);
        }
    }

    public function edit($id)
    {
        try {
            //code...
            $product = Product::findOrFail($id);

            return $this->success($product, 'edit successfully' , 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(),'Server Error',500);
        }
        
    }

    public function update(StoreProductRequest $request, Product $AdminDashboard)
    {
        try {
            $validationdata = $request->validated();
            $image = $request->file('image');

            $updatedata = $this->adminService->updatedata($validationdata, $image, $AdminDashboard);

            return $this->success($updatedata, 'Product updated successfully ', 200);
        } catch (\Throwable $th) {
            $this->error($th->getMessage(), 'Server error', 500);
        }
    }

    public function delete_item($userId, $itemId)
    {
        try {
            //code...
            $deleteproduct = $this->adminService->deleteuser($userId, $itemId);

            return $this->success(null, 'Item deleted successfully', 200);
        } catch (ModelNotFoundException $th) {
            return $this->error($th->getMessage(), 'not found', 404);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'server error', 500);
        }

        return back()->with('success', 'Item deleted!');
    }

    public function get_username($userId)
    {
        // $user = User::where('id', $userId)->first();
        // $firstName = Str::beforeLast($user->name, ' ');
        // $lastName = Str::afterLast($user->name, ' ');
        // return view('admin.useredit', compact('user', 'firstName', 'lastName'));

        try {
            //code...
           $profiledata = $this->adminService->getUserProfileData($userId);

           return $this->success($profiledata, 'user data fetch', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(),'server error',500);
        }
    }

    public function edit_user_profile(UpdateUserProfileRequest $request, $userId)
    {
        try {
            $user = $this->adminService->updateProfile($userId, $request->validated());

            return $this->success($user, 'Profile updated successfully', 200);
        } catch (ModelNotFoundException $th) {
            return $this->error('User not found', 'Not Found', 404);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Server Error', 500);
        }
    }
}
