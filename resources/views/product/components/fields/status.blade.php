@php
    use App\Models\Status;

    $status = $status ?? Status::AVAILABLE;
@endphp
<div class="w-4/5">
    <label for="status" class="block my-2 text-gray-100 my-2">{{ __('product.status') }}</label>
    <select name="status" id="status" class="w-full rounded p-2">
        <option value="available"
                @if(Status::AVAILABLE === $status) selected @endif>{{ __('status.available') }}</option>
        <option value="unavailable"
                @if(Status::UNAVAILABLE === $status) selected @endif>{{ __('status.unavailable') }}</option>
    </select>
</div>
