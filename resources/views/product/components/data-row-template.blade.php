{{-- Remplates handled by JS --}}
<div class="js-row js-row-template grid grid-cols-2 grid-rows-2 w-full auto-rows-min mt-4">

    <div>
        <label for="key[]" class=" my-2 text-white">{{ __('product.key') }}</label>
    </div>
    <div>
        <label for="value[]" class="my-2 text-white">{{ __('product.value') }}</label>
    </div>

    <div class="mr-3">
        <input type="text" name="key[]" id="key[]" class="rounded p-2 w-full">
    </div>
    <div class="flex flex-row items-center">
        <input type="text" name="value[]" id="value[]" class="rounded p-2 w-5/6 mr-2">
        <a href="#" class="js-less text-white block w-1/6">{{ __('product.less') }}</a>
    </div>

</div>
