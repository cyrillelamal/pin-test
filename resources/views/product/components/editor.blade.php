<product-editor class="flex flex-col bg-[#353F52] p-4">
    <div class="flex flex-row justify-between items-center">
        <h3 class="text-white text-xl">
            {{ __('product.editing') }}: <span class="js-product-name">{{-- product.name --}}</span>
        </h3>
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
        <button type="submit" class="rounded-md p-2 px-8 bg-sky-400 text-white">{{ __('product.save') }}</button>
    </div>
</product-editor>
