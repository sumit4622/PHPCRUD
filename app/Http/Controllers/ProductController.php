<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\Component;
use App\Services\Product\ProductService;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use League\Config\Exception\ValidationException;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            //code...
            $product = $this->productService->getdata(5);

            return $this->success($product, 'fetch product Successfully.', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'server Error', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            //code...
            $data = $request->validated();
            $product = $this->productService->create($data, $request->file('image'));

            return $this->success($product, 'created the product', 201);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'server Error', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            return $this->error(null, 'Unauthorized action', 403);
        }

        try {
            $data = $request->validated();

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('uploads', 'public');
            }

            $updatedProduct = $this->productService->update($product, $data);

            return $this->success($updatedProduct, 'Product updated successfully', 200);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), 'Server Error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            //code...
            $delete = $product->delete();

            return $this->success(null, 'Item delete sucessfully', 200);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 'Delete failed', 500);
        }
    }
}
