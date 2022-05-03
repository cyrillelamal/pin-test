@php
    use App\Models\Status;
    /**
     * @var Status $status
     */
@endphp
@switch($status ?? Status::AVAILABLE)
    @case(Status::AVAILABLE)
    {{ __('status.available') }}
    @break
    @case(Status::UNAVAILABLE)
    {{ __('status.unavailable') }}
    @break
    @default
    {{ __('status.available') }}
@endswitch
