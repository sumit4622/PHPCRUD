<?php

namespace App\Services\admin;

use App\Models\Product;
use App\Models\User; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminService
{
    public function updatedata($data, $image, $AdminDashboard)
    {
        unset($data['image']);

        if ($image) {
            $data['image'] = $image->store('uploads', 'public');
        }

        $AdminDashboard->update($data);

        return $AdminDashboard;
    }

    public function deleteuser($itemId, $userId)
    {
        $product = Product::where('id', $itemId)->where('userId', $userId)->firstOrFail();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        return $product->delete();
    }

    public function updateprofile($userId, $data)
    {
        $user = User::findOrFail($userId);

        $user->name = $data['first_name'] . ' ' . $data['last_name'];
        $user->email = $data['email'];

        $user->save();

        return $user;
    }

    public function getUserProfileData($userId)
    {
        $user = User::where('id', $userId)->first();
        $firstName = Str::beforeLast($user->name, ' ');
        $lastName = Str::afterLast($user->name, ' ');
        return [
            'user' => $user,
            'firstname' => $firstName,
            'lastname' => $lastName,
        ];
    }
}
