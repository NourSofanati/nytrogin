@php
//[#FBBC41] GOLD
//[#71579A] PURPLE
$circleColor = 'bg-gray-200';
$lineColor = 'border-gray-200';
$circleIcon = 'alarm';
$animation = '';
$words = explode('_', $status);
//dd($words);
switch ($words[1]) {
    case '1':
        if ($at == 'inspector') {
            if ($words[0] == 'pending' || $words[0] == 'declined') {
                $circleIcon = 'schedule';
                $animation = 'animate-spin';
                $circleColor = 'bg-[#FBBC41]';
            } elseif ($words[0] == 'declined') {
                $circleIcon = 'close';
                $circleColor = 'bg-red-500';
            }
        }

        break;
    case '2':
        if ($at == 'supervisor') {
            if ($words[0] == 'pending') {
                $circleIcon = 'schedule';
                $animation = 'animate-spin';
                $circleColor = 'bg-[#FBBC41]';
            } elseif ($words[0] == 'declined') {
                $circleIcon = 'close';
                $circleColor = 'bg-red-500';
            }
        }
        break;
    case '3':
        if ($at == 'procurator') {
            if ($words[0] == 'pending') {
                $circleIcon = 'schedule';
                $animation = 'animate-spin';
                $circleColor = 'bg-[#FBBC41]';
            } elseif ($words[0] == 'declined') {
                $circleIcon = 'close';
                $circleColor = 'bg-red-500';
            }
        }
        break;
    case '4':
        if ($at == 'admin') {
            if ($words[0] == 'pending') {
                $circleIcon = 'schedule';
                $animation = 'animate-spin';
                $circleColor = 'bg-[#FBBC41]';
            } elseif ($words[0] == 'declined') {
                $circleIcon = 'close';
                $circleColor = 'bg-red-500';
            }
        }
        break;
}
switch ($at) {
    case 'inspector':
        if ($words[1] > 1) {
            $circleColor = 'bg-[#71579A]';
            $circleIcon = 'check';
        }
        break;
    case 'supervisor':
        if ($words[1] > 2) {
            $circleColor = 'bg-[#71579A]';
            $circleIcon = 'check';
        }
        break;
    case 'procurator':
        if ($words[1] > 3) {
            $circleColor = 'bg-[#71579A]';
            $circleIcon = 'check';
        }
        break;
    case 'admin':
        if ($words[1] > 4) {
            $circleColor = 'bg-[#71579A]';
            $circleIcon = 'check';
        }
        break;
}
if ($words[0] == 'declined') {
    if ($at == 'inspector') {
        $circleIcon = 'schedule';
        $animation = 'animate-spin';
        $circleColor = 'bg-[#FBBC41]';
    }
}
@endphp

@if ($at != 'admin')
    <div class="h-[2px] w-[50px] border-dashed border-2  {{ $lineColor }}  mt-6"></div>
@endif
<div class="flex flex-col text-center  items-center">
    <div class="{{ $circleColor }} h-12 w-12 rounded-full grid place-items-center place-content-center text-white">
        <span class="material-icons {{ $animation }}">
            {{ $circleIcon }}
        </span>
    </div>
    <p class="my-auto font-bold ">
        {{ __($at . 's') }}
    </p>
</div>
