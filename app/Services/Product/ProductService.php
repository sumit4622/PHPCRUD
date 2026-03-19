<?php

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    public function getdata($perpage)
    {
        $products = Product::where('user_id', Auth::id())->orderBy('created_at')->paginate($perpage);

        return $products;
    }

    public function create(array $data, $imageFile)
    {
        $data['user_id'] = auth()->id();

        if ($imageFile) {
            $data['image'] = $imageFile->store('uploads', 'public');
        }

        return Product::create($data);
    }

    public function update(Product $product, array $data)
    {
        if (isset($data['image']) && $product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->update($data);

        return $product->fresh();
    }
}
