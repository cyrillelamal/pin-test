<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

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

    #[OA\Post(
        path: '/products',
        description: 'Add new product',
        requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/StoreProductRequest')),
        responses: [
            new OA\Response(response: 201, description: 'Product added', content: new OA\JsonContent(ref: '#/components/schemas/ProductResource')),
        ],
    )]
    public function store(StoreProductRequest $request): ProductResource
    {
        // FIXME: what to do with an empty set of attributes (data)?
        $product = Product::query()->create($request->validated());

        return new ProductResource($product); // 201 automatically
    }

    #[OA\Get(
        path: '/products/{id}',
        description: 'Read product',
        parameters: [
            new OA\Parameter(name: 'id', description: 'Product id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Product', content: new OA\JsonContent(ref: '#/components/schemas/ProductResource')),
        ],
    )]
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    /**
     * @throws AuthorizationException
     */
    #[OA\Put(
        path: '/products/{id}',
        description: 'Read product',
        requestBody: new OA\RequestBody(content: new OA\JsonContent(ref: '#/components/schemas/UpdateProductRequest')),
        parameters: [
            new OA\Parameter(name: 'id', description: 'Product id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Updated product', content: new OA\JsonContent(ref: '#/components/schemas/ProductResource')),
        ],
    )]
    public function update(UpdateProductRequest $request, Product $product): ProductResource
    {
        $this->authorize('update', $product);

        $product->update($request->validated());

        return new ProductResource($product);
    }

    #[OA\Delete(
        path: '/products/{id}',
        description: 'Delete product',
        parameters: [
            new OA\Parameter(name: 'id', description: 'Product id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 204, description: 'Product was removed softly'),
        ],
    )]
    public function destroy(Product $product): Response
    {
        $product->delete();

        return response(null, 204);
    }
}
