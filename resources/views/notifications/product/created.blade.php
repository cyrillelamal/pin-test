@php
    use App\Models\Product;
    /**
     * @var Product $product
     */
@endphp
@extends('base')
@section('main')
    <h1 class="text-2xl text-black">
        {{ __('product.notifications.created', ['name' => $product->name, 'article' => $product->article]) }}
    </h1>
@endsection
