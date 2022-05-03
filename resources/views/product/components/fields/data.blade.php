{{-- Also known as attributes --}}
{{-- Empty container with a template. It is handled by JS --}}
<div class="js-product-data my-8">
    <h4 class="text-white font-semibold mb-4">{{ __('product.data') }}</h4>

    <div class="js-container flex flex-col w-4/5">{{-- Append data rows here --}}</div>

    <div class="mt-6 text-blue-200">
        <a href="#" class="js-more underline underline-offset-4 decoration-dashed">{{ __('product.more') }}</a>
    </div>

    <div class="hidden">
        @include('product.components.data-row-template')
    </div>
</div>
