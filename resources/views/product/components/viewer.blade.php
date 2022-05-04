<product-viewer class="flex flex-col bg-[#353F52]">
    <div class="flex flex-row justify-between items-center p-4">
        <h3 class="js-product-name text-white text-xl">{{-- product.name --}}</h3>
        <div class="flex flex-row items-center">
            <div class="text-white text-xs">
                <button class="js-edit bg-[#202531] p-1">{{ __('product.edit') }}</button>
                <button class="js-destroy bg-[#202531] p-1">{{ __('product.destroy') }}</button>
            </div>
            <div class="ml-4">
                <button class="js-hide text-gray-200 text-2xl">{{ __('product.hide') }}</button>
            </div>
        </div>
    </div>
    <div class="flex flex-row justify-start p-4 mb-8 text-base">
        <div class="flex flex-col text-gray-300">
            <div class="mt-2">{{ __('product.article') }}:</div>
            <div class="mt-2">{{ __('product.name') }}:</div>
            <div class="mt-2">{{ __('product.status') }}:</div>
            <div class="mt-2">{{ __('product.data') }}:</div>
        </div>
        <div class="flex flex-col ml-4 text-white">
            {{-- Without nbsps the grid is broken, if some fields are empty (null) --}}
            <div class="js-product-article mt-2">&nbsp;{{-- product.article --}}</div>
            <div class="js-product-name mt-2">&nbsp;{{-- product.name --}}</div>
            <div class="js-product-status mt-2">&nbsp;{{-- product.status --}}</div>
            <div class="js-product-data mt-2">&nbsp;{{-- product.data --}}</div>
        </div>
    </div>
</product-viewer>
