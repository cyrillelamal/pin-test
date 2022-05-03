@php
    use App\Models\Product;
    /**
     * @var Product $product
     */
@endphp
@foreach($product->data as $key => $value)
    {{ $key }}: {{ $value }} <br>
    {{--    {{ __('data.'.$key) }}: {{ $value }} <br>--}}
@endforeach
