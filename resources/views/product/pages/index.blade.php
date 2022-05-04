@php
    use App\Models\Product;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
    /**
     * @var LengthAwarePaginator|Product[] $products
     */
@endphp
@extends('base')
@section('main')
    <section class="flex flex-row min-h-screen bg-[#F1F6FB] text-base">
        <div class="bg-[#353F52]">@include('product.components.sidebar')</div>
        <div class="flex flex-col w-full">
            <div>@include('product.components.navbar')</div>
            <div class="grid grid-cols-2 grid-rows-1">
                <div>@include('product.components.list')</div>
                <div>@include('product.components.controls')</div>
            </div>
        </div>
    </section>
@endsection
