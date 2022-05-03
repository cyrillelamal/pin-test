<product-editor class="flex flex-col bg-sky-900 p-4">
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
        <button type="submit">{{ __('product.save') }}</button>
    </div>
</product-editor>
