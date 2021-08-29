@php
//[#FBBC41] GOLD
//[#71579A] PURPLE
$circleColor = 'bg-gray-200';
$lineColor = 'border-gray-200';
$circleIcon = 'alarm';
$animation = '';
if ($at == 'inspector') {
    if ($status == 'draft') {
        $circleIcon = 'schedule';
        $circleColor = 'bg-[#FBBC41]';
        $animation = 'animate-spin';
    } else {
        $circleIcon = 'check';
        $circleColor = 'bg-[#71579A]';
    }
} else {
}

@endphp
@if ($at != 'admin')
    <div class="h-[50px] border-dashed border-2 w-[1px] {{ $lineColor }} mr-[21px] my-2"></div>
@endif
<div class="flex">
    <div class="{{ $circleColor }} h-12 w-12 rounded-full grid place-items-center place-content-center text-white">
        <span class="material-icons {{ $animation }}">
            {{ $circleIcon }}
        </span>
    </div>
    <p class="my-auto font-bold mr-5">
        {{ __($at . 's') }}
    </p>
</div>
