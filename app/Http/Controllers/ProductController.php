<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(): View
    {
        // FIXME: it should be paginated, isn't it?
        $products = Product::query()->paginate();

        return view('product.pages.index', [
            'products' => $products,
        ]);
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        // FIXME: what to do with an empty set of attributes (data)?
        $product = Product::query()->create($request->validated());

        return new ProductResource($product); // 201 automatically
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        return new ProductResource($product);
    }

    public function destroy(Product $product): Response
    {
        $product->delete();

        return response(null, 204);
    }
}
