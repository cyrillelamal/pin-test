@php
    use App\Models\Product;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
    /**
     * @var LengthAwarePaginator|Product[] $products
     */
@endphp
<table class="text-sm">
    <thead class="text-gray-700 uppercase border-b-2">
    <tr>
        <td class="p-4">{{ __('product.article') }}</td>
        <td class="p-4">{{ __('product.name') }}</td>
        <td class="p-4">{{ __('product.status') }}</td>
        <td class="p-4">{{ __('product.data') }}</td>
    </tr>
    </thead>
    <tbody class="bg-white">
    @foreach($products as $product)
        @include('product.components.row', ['product' => $product])
    @endforeach
    </tbody>
</table>
