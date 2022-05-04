{{-- Rather form controls: form and btton --}}
<new-product-form class="flex flex-col">
    <form action="{{ route('products.store') }}" class="flex flex-col bg-[#353F52] p-4">
        <div class="flex flex-row justify-between items-center">
            <h3 class="text-white text-xl font-bold">{{ __('product.new') }}</h3>
            <div class="flex flex-row items-center">
                <div class="ml-4">
                    <button class="js-hide text-gray-200 text-2xl">{{ __('product.hide') }}</button>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-start my-8">
            @include('product.components.fields.article')
            @include('product.components.fields.name')
            @include('product.components.fields.status')
            @include('product.components.fields.data')
            <div class="mt-4">
                <button type="submit"
                        class="rounded-md p-2 px-8 bg-sky-400 text-white">{{ __('product.save') }}</button>
            </div>
        </div>
    </form>
    <div class="flex flex-row-reverse p-4">
        <button class="js-show rounded-md p-2 px-8 bg-sky-400 text-white">{{ __('product.add') }}</button>
    </div>
</new-product-form>
