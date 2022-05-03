@php
    use \App\Http\Resources\ProductResource;
    use App\Models\Product;
    /**
     * @var Product $product
     */
@endphp
<tr class="js-product-row border-b-2" data-product="{{ (new ProductResource($product))->toJson() }}">
    <td class="p-2">{{ $product->article }}</td>
    <td class="p-2">{{ $product->name }}</td>
    <td class="p-2">@include('product.components.status', ['status' => $product->status])</td>
    <td class="p-2">@include('product.components.data-flat', ['product' => $product])</td>
</tr>
